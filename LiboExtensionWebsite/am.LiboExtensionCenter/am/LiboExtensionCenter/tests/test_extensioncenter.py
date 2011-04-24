from base import LECTestCase

from DateTime.DateTime import DateTime

from am.LiboExtensionCenter.tests.utils import verifyURLWithRequestVars

class TestExtensionCenter(LECTestCase):

    def afterSetUp(self):
        self.setRoles(('Manager',))
        self.portal.invokeFactory('LiboExtensionCenter', 'lec')
        self.lec = self.portal.lec
    
    def testValidateAvailableCategories(self):
        self.lec.invokeFactory('LECProject', 'p')
        
        dangerousCategory = ['p|products|Products']
        safeCategory = ['q|quick|Quick']
        
        self.assertEqual(None, self.lec.validate_availableCategories(safeCategory))
        self.assertNotEqual(None, self.lec.validate_availableCategories(dangerousCategory))
        self.assertNotEqual(None, self.lec.validate_availableCategories(safeCategory + dangerousCategory))
    
    def testEditFields(self):
        self.lec.setDescription('A description for an Extension Center')
        self.assertEqual('A description for an Extension Center', self.lec.Description())
        
        self.lec.setAvailableCategories([
          'cat1|Category 1|Projects of category 1',
          'cat2|Category 2|Projects of category 2',
          ])
        self.assertEqual((
          'cat1|Category 1|Projects of category 1',
          'cat2|Category 2|Projects of category 2',
          ),
          self.lec.getAvailableCategories())
        
        self.lec.setAvailableLicenses([
          'lic1|License 1|http://localhost/license1',
          'lic2|License 2|http://localhost/license2',
          ])
        self.assertEqual((
          'lic1|License 1|http://localhost/license1',
          'lic2|License 2|http://localhost/license2',
          ),
          self.lec.getAvailableLicenses())
        
        self.lec.setAvailableVersions([
          '2.0',
          '1.0',
          ])
        self.assertEqual((
          '2.0',
          '1.0',
          ),
          self.lec.getAvailableVersions())
        
        self.lec.setAvailablePlatforms([
          'Platform 2',
          'Platform 1',
          ])
        self.assertEqual((
          'Platform 2',
          'Platform 1',
          ),
          self.lec.getAvailablePlatforms())
        
        self.lec.setProjectEvaluators([
          'member1',
          'member2',
          ])
        self.assertEqual((
          'member1',
          'member2',
          ),
          self.lec.getProjectEvaluators())
        
        self.lec.setAvailableSelfCertificationCriteria([
          'Criterion 1',
          'Criterion 2',
          ])
        self.assertEqual((
          'Criterion 1',
          'Criterion 2',
          ),
          self.lec.getAvailableSelfCertificationCriteria())
        
        self.assertEqual(False, self.lec.getUseClassifiers())
        self.lec.setUseClassifiers(True)
        self.assertEqual(True, self.lec.getUseClassifiers())
         
    def testGetAvailableCategoriesAsDisplayList(self):
        self.lec.setAvailableCategories([
          'cat1|Category 1|Projects of category 1',
          'cat2|Category 2|Projects of category 2',
          ])
        self.assertEqual(
          (('cat1', 'Category 1'), ('cat2', 'Category 2')),
          self.lec.getAvailableCategoriesAsDisplayList().items()
          )
    
    def testGetAvailableLicensesAsDisplayList(self):
        self.lec.setAvailableLicenses([
          'lic1|License 1|http://localhost/license1',
          'lic2|License 2|http://localhost/license2',
          ])
        self.assertEqual(
          (('lic1', 'License 1'), ('lic2', 'License 2')),
          self.lec.getAvailableLicensesAsDisplayList().items()
          )
    
    def testGetAvailableVersionsAsDisplayList(self):
        self.lec.setAvailableVersions([
          '2.0',
          '1.0',
          ])
        self.assertEqual(
          (('2.0', '2.0'), ('1.0', '1.0')),
          self.lec.getAvailableVersionsAsDisplayList().items())
    
    def testGetAvailableSelfCertificationCriteriaAsDisplayList(self):
        self.lec.setAvailableSelfCertificationCriteria([
          'Criterion 1',
          'Criterion 2',
          ])
        self.assertEqual(
          (('Criterion 1', 'Criterion 1'), ('Criterion 2', 'Criterion 2')),
          self.lec.getAvailableSelfCertificationCriteriaAsDisplayList().items())

class TestExtensionCenterRoles(LECTestCase):

    def afterSetUp(self):
        self.setRoles(('Manager',))
        self.portal.invokeFactory('LiboExtensionCenter', 'lec')
        self.lec = self.portal.lec
    
    def testProjectEvaluatorRole(self):
        self.failUnless('LECEvaluator' in self.lec.validRoles())

class TestExtensionCenterAsContainer(LECTestCase):

    def afterSetUp(self):
        self.setRoles(('Manager',))
        self.portal.invokeFactory('LiboExtensionCenter', 'lec')
        self.lec = self.portal.lec
        
        for id in ['proj4', 'proj3', 'proj2', 'proj1']: 
            self.lec.invokeFactory('LECProject', id)
        
        self.lec.setCategories(self.lec.proj4, ['cat1'])
        self.lec.setCategories(self.lec.proj3, ['cat1'])
        self.lec.setCategories(self.lec.proj2, ['cat2'])
        self.lec.setCategories(self.lec.proj1, ['cat1','cat2'])
        
        self.lec.proj4.content_status_modify(workflow_action='publish')
        self.lec.proj3.content_status_modify(workflow_action='publish')
        self.lec.proj2.content_status_modify(workflow_action='publish')
    
    def testGetProjectsByCategory(self):
        objs = [brain.getObject() for brain in self.lec.getProjectsByCategory(
          'cat1')]
        self.assertEqual([self.lec.proj1, self.lec.proj3, self.lec.proj4],
          objs)
        
        objs = [brain.getObject() for brain in self.lec.getProjectsByCategory(
          'cat1', states=['published',])]
        self.assertEqual([self.lec.proj3, self.lec.proj4], objs)
        
        objs = [brain.getObject() for brain in self.lec.getProjectsByCategory(
          'cat1', limit=2)]
        self.assertEqual([self.lec.proj1, self.lec.proj3], objs)    
    
    def test_getContained(self):
        objs = [brain.getObject() for brain in self.lec._getContained(
          states=['published'], portal_type='LECProject')]
        self.assertEqual([self.lec.proj2, self.lec.proj3, self.lec.proj4],
          objs)
        
        objs = [brain.getObject() for brain in self.lec._getContained(
          category='cat1', portal_type='LECProject')]
        self.assertEqual([self.lec.proj1, self.lec.proj3, self.lec.proj4],
          objs)
        
        self.assertEqual([], self.lec._getContained(portal_type='DummyType'))
        
        objs = [brain.getObject() for brain in self.lec._getContained(
          portal_type='LECProject', limit=2)]
        self.assertEqual([self.lec.proj1, self.lec.proj2],
          objs)
        
        objs = [brain.getObject() for brain in self.lec._getContained(
          portal_type='LECProject', sort_on='sortable_title', sort_order='reverse')]
        self.assertEqual([self.lec.proj4, self.lec.proj3, self.lec.proj2,
          self.lec.proj1], objs)

class TestExtensionCenterView(LECTestCase):
    
    def afterSetUp(self):
        self.setRoles(('Manager',))
        self.portal.invokeFactory('LiboExtensionCenter', 'lec')
        self.lec = self.portal.lec
        self.resetView()
        
    def resetView(self):
        self.view = self.lec.restrictedTraverse('@@extensioncenter_view')
    
    def testViewLookup(self):
        self.failIf(self.view is None)
        
    def test_rss_url(self):
        self.failUnless(verifyURLWithRequestVars(
          self.view.rss_url(),
          'http://nohost/plone/lec/search_rss',
          ['portal_type=LECRelease', 'sort_on=Date',
          'sort_order=reverse', 'review_state=alpha', 'review_state=beta',
          'review_state=release-candidate', 'review_state=final']
          ))
    
    def test_active_projects(self):
        for id in ['proj1', 'proj2', 'proj3', 'proj4']: 
            self.lec.invokeFactory('LECProject', id)
            self.lec[id].content_status_modify(workflow_action = 'publish')
        self.lec.invokeFactory('LECProject', 'proj5')
        
        for id in ['proj1', 'proj2', 'proj3']:
            self.lec[id].releases.invokeFactory('LECRelease', '1.0')
        
        self.resetView()
        results = self.view.active_projects()
        self.assertEqual(0, len(results))
        
        self.lec.proj1.releases['1.0'].content_status_modify(
          workflow_action = 'release-alpha')
        self.lec.proj3.releases['1.0'].content_status_modify(
          workflow_action = 'release-candidate')
        
        self.resetView()
        results = self.view.active_projects()
        self.assertEqual(2, len(results))
        
        self.lec.proj1.releases['1.0'].content_status_modify(
          workflow_action = 'retract')
        
        self.resetView()
        results = self.view.active_projects()
        self.assertEqual(1, len(results))
    
    def test_can_add_project(self):
        self.lec.manage_permission('LiboExtensionCenter: Add Project',
           roles=['Member'], acquire=0)
        
        self.setRoles(['Member'])
        self.failUnless(self.view.can_add_project())
        
        self.lec.manage_permission('LiboExtensionCenter: Add Project',
           roles=['Manager'], acquire=0)
        
        self.failIf(self.view.can_add_project())
        self.setRoles(['Manager'])
        self.failUnless(self.view.can_add_project())
    
    def test_project_count(self):
        for id in ['proj1', 'proj2', 'proj3', 'proj4']: 
            self.lec.invokeFactory('LECProject', id)
        
        self.resetView()
        self.assertEqual(4, self.view.project_count())
    
    def test_release_count(self):
        for i in range(1,5):
            proj_id = 'proj%s' % str(i)
            self.lec.invokeFactory('LECProject', proj_id)
            for j in range(1,i+1):
                release_id = '%s.0' % str(j)
                self.lec[proj_id].releases.invokeFactory('LECRelease',
                  release_id)
        
        self.resetView()
        self.assertEqual(10, self.view.release_count())
    
    def test_categories(self):
        self.lec.setAvailableCategories([
          'cat1|Category 1|Projects of category 1',
          'cat2|Category 2|Projects of category 2',
          'cat3|Category 3|Projects of category 3',
          ])
        self.lec.invokeFactory('LECProject', 'proj1')
        self.lec.invokeFactory('LECProject', 'proj2')
        self.lec.invokeFactory('LECProject', 'proj3')
        
        self.lec.proj1.setCategories(['cat1'])
        self.lec.proj1.reindexObject()
        self.lec.proj2.setCategories(['cat1', 'cat2'])
        self.lec.proj2.reindexObject()
        
        self.lec.proj1.setTitle('Project A')
        self.lec.proj1.releases.invokeFactory('LECRelease', '1.0')
        self.lec.proj1.releases['1.0'].setDescription('A release')
        self.lec.proj1.releases['1.0'].setEffectiveDate(DateTime('1/2/2000'))
        self.lec.proj1.releases['1.0'].reindexObject()
        self.lec.proj2.setTitle('Project B')
        self.lec.proj2.releases.invokeFactory('LECRelease', '1.0')
        self.lec.proj2.releases['1.0'].setDescription('A release')
        self.lec.proj2.releases['1.0'].setEffectiveDate(DateTime('1/1/2000'))
        self.lec.proj2.releases['1.0'].reindexObject()
        
        self.resetView()
        categories = list(self.view.categories())
        
        #cat1, cat2 are stored in that order in self.lec
        #So, self.view.categories() should also return the category info
        #for cat1 first, and cat2 second
        
        self.assertEqual(2, len(categories))
        keys1, keys2 = categories[0].keys(), categories[1].keys()
        keys1.sort()
        keys2.sort()
        
        self.assertEqual(['description', 'id', 'name', 'num_projects',
          'releases', 'rss_url'], keys1)
        self.assertEqual(['description', 'id', 'name', 'num_projects',
          'releases', 'rss_url'], keys2)
        
        # verify description, id, name, num_projects
        self.assertEqual('Category 1', categories[0]['name'])
        self.assertEqual('Projects of category 1', categories[0]['description'])
        self.assertEqual(2, categories[0]['num_projects'])
        self.assertEqual('cat1', categories[0]['id'])
        
        self.assertEqual('Category 2', categories[1]['name'])
        self.assertEqual('Projects of category 2', categories[1]['description'])
        self.assertEqual(1, categories[1]['num_projects'])
        self.assertEqual('cat2', categories[1]['id'])
        
        # verify rss_url for cat1 (we skip the analogous test for cat2)
        self.failUnless(verifyURLWithRequestVars(
          categories[0]['rss_url'],
          'http://nohost/plone/search_rss',
          ['portal_type=LECRelease', 'sort_on=Date',
          'sort_order=reverse', 'path=/plone/lec', 'getCategories=cat1',
          'review_state=alpha', 'review_state=beta',
          'review_state=release-candidate', 'review_state=final']
          ))
           
        #verify releases for cat1 (we skip the analogous test for cat2)
        #and only for the first release in the list, which is Project A 1.0
        #because it was released later
        self.assertEqual(2, len(categories[0]['releases']))
        releaseDict = categories[0]['releases'][0]
        keys = releaseDict.keys()
        keys.sort()
        self.assertEqual(['date', 'description', 'parent_url', 'review_state',
          'title'], keys)
        
        self.assert_(releaseDict['date'].startswith('2000-01-02'))
        self.assertEqual('A release', releaseDict['description'])
        self.assertEqual(
          'http://nohost/plone/lec/proj1', releaseDict['parent_url'])
        self.assertEqual('pre-release', releaseDict['review_state'])
        self.assertEqual('Project A 1.0 (Unreleased)', releaseDict['title'])


def test_suite():
    from unittest import TestSuite, makeSuite
    suite = TestSuite()
    suite.addTest(makeSuite(TestExtensionCenter))
    suite.addTest(makeSuite(TestExtensionCenterRoles))
    suite.addTest(makeSuite(TestExtensionCenterView))
    return suite
