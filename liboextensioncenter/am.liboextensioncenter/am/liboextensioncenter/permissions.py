"""
$Id: permissions.py 65992 2008-06-01 00:40:45Z rossp $
"""
from Products.CMFCore.permissions import setDefaultRoles

AddExtensionCenter = "LibOExtensionCenter: Add Extension Center"
AddProject = 'LibOExtensionCenter: Add Project'
AddReviewComment = 'LibOExtension: Add Review Comment'
ApproveProject = 'LibOExtensionCenter: Approve Project'

# Let members add new projects, but only manager add help centres
setDefaultRoles(AddSoftwareCenter, ('Manager',))

# Setting this by default and controlling with area workflow means factory
# works
setDefaultRoles(AddProject, ('Manager','Owner',))

setDefaultRoles(AddReviewComment, ('Manager', 'LECEvaluator',))
setDefaultRoles(ApproveProject, ('Manager', 'LECEvaluator',))
