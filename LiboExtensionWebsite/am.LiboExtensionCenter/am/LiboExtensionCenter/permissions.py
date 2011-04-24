"""
$Id: permissions.py 65992 2008-06-01 00:40:45Z rossp $
"""
from Products.CMFCore.permissions import setDefaultRoles

AddExtensionCenter = "LiboExtensionCenter: Add Extension Center"
AddProject = 'LiboExtensionCenter: Add Project'
AddReviewComment = 'LiboExtension: Add Review Comment'
ApproveProject = 'LiboExtensionCenter: Approve Project'

# Let members add new projects, but only manager add help centres
setDefaultRoles(AddExtensionCenter, ('Manager',))

# Setting this by default and controlling with area workflow means factory
# works
setDefaultRoles(AddProject, ('Manager','Owner',))

setDefaultRoles(AddReviewComment, ('Manager', 'LECEvaluator',))
setDefaultRoles(ApproveProject, ('Manager', 'LECEvaluator',))
