"""
$Id: permissions.py 65992 2008-06-01 00:40:45Z rossp $
"""
from Products.CMFCore.permissions import setDefaultRoles

AddSoftwareCenter = "liboextensioncenter: Add Extension Center"
AddProject = 'liboextensioncenter: Add Project'
AddReviewComment = 'liboextension: Add Review Comment'
ApproveProject = 'liboextensioncenter: Approve Project'

# Let members add new projects, but only manager add help centres
setDefaultRoles(AddSoftwareCenter, ('Manager',))

# Setting this by default and controlling with area workflow means factory
# works
setDefaultRoles(AddProject, ('Manager','Owner',))

setDefaultRoles(AddReviewComment, ('Manager', 'LECEvaluator',))
setDefaultRoles(ApproveProject, ('Manager', 'LECEvaluator',))
