"""
$Id: LECReleaseFolder.py 2011-04-23 andreasma $
"""

from zope.interface import implements

from am.LiboExtensionCenter.interfaces import IReleaseFolderContent

from AccessControl import ClassSecurityInfo
from Products.CMFCore import permissions
from Products.CMFCore.utils import getToolByName

from Products.Archetypes.atapi import *
try:
    import transaction
except ImportError:  # BBB
    from Products.Archetypes import transaction

from Products.ATContentTypes.content.base import ATCTMixin

from am.LiboExtensionCenter import config

LECReleaseFolderSchema = OrderedBaseFolderSchema.copy() + Schema((

    StringField(
        name='id',
        required=0,
        searchable=1,
        mode='r', # Leave the custom auto-generated ID
        widget=StringWidget (
            label="Short name",
            label_msgid="label_releasefolder_short_name",
            description="Short name of the container - this should be 'release' to comply with the standards.",
            description_msgid="help_releasefolder_short_name",
            i18n_domain="liboextensioncenter",
        ),
    ),

    StringField(
        name='title',
        default='Releases',
        searchable=1,
        accessor="Title",
        widget=StringWidget(
            label="Title",
            label_msgid="label_release_title",
            description="Enter a title for the container",
            description_msgid="help_release_title",
            i18n_domain="liboextensioncenter",
        ),
    ),

    StringField(
        name='description',
        default='Existing and upcoming releases for this project.',
        searchable=1,
        accessor="Description",
        widget=TextAreaWidget(
            label="Description",
            label_msgid="label_release_description",
            description="Enter a description of the container",
            description_msgid="help_release_description",
            i18n_domain="liboextensioncenter",
        ),
    ),

))

class LECReleaseFolder(ATCTMixin, OrderedBaseFolder):
    """Folder type for holding releases."""

    implements(IReleaseFolderContent)

    archetype_name = 'Releases Section'
    immediate_view = default_view = 'lec_releasefolder_view'
    content_icon = 'download_icon.gif'
    schema = LECReleaseFolderSchema

    security = ClassSecurityInfo()

    global_allow = 0
    filter_content_types = 1
    allowed_content_types = ('LECRelease',)
    _at_rename_after_creation = True

    typeDescMsgId = 'description_edit_releasefolder'
    typeDescription = ('A Releases Section is used to hold software '
                       'releases. It is given a default short name and '
                       'title to ensure that projects are consistent. '
                       'Please do not rename it.')

    def _renameAfterCreation(self, check_auto_id=False):
        parent = self.aq_inner.aq_parent
        if config.RELEASES_ID not in parent.objectIds():            
            # Can't rename without a subtransaction commit when using
            # portal_factory!
            transaction.savepoint(optimistic=True)
            self.setId(config.RELEASES_ID)

    security.declareProtected(permissions.View, 'generateUniqueId')
    def generateUniqueId(self, type_name):
        """Override for the .py script in portal_scripts with the same name.

        Gives some default names for contained content types.
        """

        if type_name != 'LECRelease':
            return self.aq_parent.generateUniqueId(type_name)

        # Generate a fake version number, to signify that the user needs to
        # correct it

        # find the highest-used major version
        ids = self.objectIds()

        def getMajor(i):
            try:
                return int(float(i))
            except ValueError:
                return 0

        def getMinor(i):
            if '.' in i:
                try:
                    return int(float(i[i.find('.')+1:]))
                except ValueError:
                    return 0

        majors, minors = ([getMajor(id) for id in ids],
                          [getMinor(id) for id in ids])

        if majors:
            major = max(majors) or 1
        else:
            major = 1

        if minors:
            minor = max(minors)
        else:
            minor = 0

        while '%s.%s' % (major, minor,) in self.objectIds():
            minor += 1
        return '%s.%s' % (major, minor)

registerType(LECReleaseFolder, config.PROJECTNAME)
