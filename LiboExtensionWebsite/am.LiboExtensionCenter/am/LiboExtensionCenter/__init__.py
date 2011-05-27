"""
$Id: __init__.py 65648 2008-05-24 23:05:46Z maurits $
"""

from Products.CMFCore.utils import ContentInit
from Products.CMFCore.DirectoryView import registerDirectory

from Products.Archetypes.atapi import listTypes, process_types

from am.LiboExtensionCenter import config
from am.LiboExtensionCenter import permissions as lec_permissions
from Products.CMFCore import permissions

from Products.validation import validation
from am.LiboExtensionCenter import validators
validation.register(validators.ProjectIdValidator('isNonConflictingProjectId'))
validation.register(validators.ProjectContactValidator('isValidContact'))

registerDirectory(config.SKINS_DIR, config.GLOBALS)

def initialize(context):
    # Kick content registration and sys.modules mangling
    from am.LiboExtensionCenter import content

    allTypes = listTypes(config.PROJECTNAME)

    # Register Archetypes content with the machinery
    content_types, constructors, ftis = process_types(
        allTypes, config.PROJECTNAME)

    center_content_types = []
    center_constructors  = []

    project_content_types  = []
    project_constructors   = []

    member_content_types  = []
    member_constructors   = []

    for i in range(len(allTypes)):
        aType = allTypes[i]
        if aType['klass'].meta_type in ('LiboExtensionCenter',):
            center_content_types.append(content_types[i])
            center_constructors.append(constructors[i])
        elif aType['klass'].meta_type in ('LECProject',):
            project_content_types.append(content_types[i])
            project_constructors.append(constructors[i])
        else:
            member_content_types.append(content_types[i])
            member_constructors.append(constructors[i])

    # software center itself
    ContentInit(
        config.PROJECTNAME + ' Center',
        content_types = tuple(center_content_types),
        permission = lec_permissions.AddExtensionCenter,
        extra_constructors = tuple(center_constructors),
        fti = ftis,
        ).initialize(context)

    # projects
    ContentInit(
        config.PROJECTNAME + ' Project',
        content_types = tuple(project_content_types),
        permission = lec_permissions.AddProject,
        extra_constructors = tuple(project_constructors),
        fti = ftis,
        ).initialize(context)

    # regular content
    ContentInit(
        config.PROJECTNAME + ' Project Content',
        content_types = tuple(member_content_types),
        permission = permissions.AddPortalContent,
        extra_constructors = tuple(member_constructors),
        fti = ftis,
        ).initialize(context)
