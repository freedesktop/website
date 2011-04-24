"""Integration tests for reviewer security.

These tests ensure that certain actions can be done only by reviewers.
"""

import unittest
from Testing.ZopeTestCase import ZopeDocTestSuite

from base import LECFunctionalTestCase
from utils import optionflags

def test_edit_project_fields():
    """A project contains two fields that an owner should not be able to
    edit, but that a reviewer should be able to.

    First, in order to create LECs in Member folders, we enable the
    creation of Member folders (disabled by default in Plone 3).

        >>> null = self.portal.portal_membership.setMemberareaCreationFlag()

    First we do some basic setup
    
        >>> from Products.CMFCore.utils import getToolByName
        >>> from Products.Five.testbrowser import Browser
        >>> wf_tool = getToolByName(self.portal, 'portal_workflow')
        >>> browser = Browser()
        >>> browser.handleErrors = False
        
        >>> def browserLogin(id, password):
        ...     browser.open(self.portal.absolute_url() + '/logout')
        ...     browser.open(self.portal.absolute_url() + '/login_form')
        ...     browser.getControl('Login Name').value = id
        ...     browser.getControl('Password').value = password
        ...     browser.getControl('Log in').click()
    
    
    We create various users.
    * Software Center Creator: member1
    * LECEvaluator: member2
    * Project Creator: member3
    * Generic User: member4
    
        >>> from am.LiboExtensionCenter.permissions import AddExtensionCenter
        >>> self.portal.manage_permission(AddExtensionCenter,
        ...   ['Manager', 'Owner'])
        >>> from am.LiboExtensionCenter.tests import utils
        >>> utils.setUpDefaultMembers(self.portal)
        
    One member creates a software center, and another is promoted to Evaluator.
    First we log in with the testbrowser to ensure that the member's folder is
    created.
    
        >>> browserLogin('member1', 'secret')
        
    Now we create the software center.
    
        >>> self.login('member1')
        >>> self.portal.Members.member1.invokeFactory('LiboExtensionCenter',
        ...   'lec')
        '...'
        >>> self.lec = self.portal.Members.member1.lec
        >>> self.lec.setProjectEvaluators(['member2',])
    
    Next, a member creates a project and the center creator approves it.
    
        >>> self.login('member3')
        >>> self.lec.invokeFactory('LECProject', 'proj')
        '...'
        >>> self.proj = self.lec.proj
        >>> self.proj.content_status_modify(workflow_action='submit')
        '...'
        >>> self.login('member1')
        >>> self.proj.content_status_modify(workflow_action='publish')
        '...'
        >>> wf_tool.getInfoFor(self.proj, 'review_state')
        'published'
    
    Now, the member edits the project and we verify that the member cannot
    edit the "gold star approval" field or "the review comment".
    
        >>> browserLogin('member3', 'secret')
        >>> browser.open(self.proj.absolute_url())
        >>> browser.getLink('Edit').click()

    The `Approved` control does not exists anymore for approving the project
    but still exists in the classifier list on the form::

        >>> browser.getControl('Approved')   
        <ItemControl name='classifiers:list' ...>

    Review should not be present::

        >>> browser.getControl('Review Comment')
        Traceback (most recent call last):
        ...
        LookupError: label 'Review Comment'

    We need to validate the screen so the object is not locked anymore::

        >>> unlock_url = '%s/@@plone_lock_operations/force_unlock' % self.proj.absolute_url()
        >>> browser.open(unlock_url)
    
    However, the software center creator and the LECEvaluator can edit
    these fields.
    
        >>> browserLogin('member1', 'secret')
        >>> browser.open(self.proj.absolute_url())
        >>> browser.getLink('Edit').click()
        >>> 'Indicate whether this project is approved by product reviewers.' in browser.contents
        True
        >>> browser.getControl('Review Comment')
        <Control ...>
        >>> browser.open(unlock_url)

        >>> browserLogin('member2', 'secret')
        >>> browser.open(self.proj.absolute_url())
        >>> browser.getLink('Edit').click()
        
        >>> 'Indicate whether this project is approved by product reviewers.' in browser.contents
        True
        >>> browser.getControl('Review Comment')
        <Control ...>
        >>> browser.open(unlock_url)

    Change who the LECEvaluators are and see if the changes stick.
    
        >>> self.lec.setProjectEvaluators(['member3',])
        
        >>> browserLogin('member2', 'secret')
        >>> browser.open(self.proj.absolute_url())
        >>> browser.getLink('Edit').click()
        Traceback (most recent call last):
        ...
        LinkNotFoundError
        
        >>> browserLogin('member3', 'secret')
        >>> browser.open(self.proj.absolute_url())
        >>> browser.getLink('Edit').click()
        >>> 'Indicate whether this project is approved by product reviewers.' in browser.contents
        True
        >>> browser.getControl('Review Comment')
        <Control ...>
"""


def test_suite():
    return unittest.TestSuite((
            ZopeDocTestSuite(test_class=LECFunctionalTestCase,
                             optionflags=optionflags),
        ))
