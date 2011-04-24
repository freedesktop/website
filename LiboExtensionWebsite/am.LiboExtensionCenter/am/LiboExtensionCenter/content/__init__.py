"""
$Id: __init__.py 32542 2006-10-30 21:20:50Z optilude $
"""

import sys

import root
import docfolder
import downloadablefile
import filelink
import proposal
import proposalfolder
import project
import release
import releasefolder

sys.modules['am.LiboExtensionCenter.content.LiboExtensionCenter'] = root
sys.modules['am.LiboExtensionCenter.content.LECDocumentationFolder'] = docfolder
sys.modules['am.LiboExtensionCenter.content.LECFile'] = downloadablefile
sys.modules['am.LiboExtensionCenter.content.LECFileLink'] = filelink
sys.modules['am.LiboExtensionCenter.content.LECImprovementProposal'] = proposal
sys.modules['am.LiboExtensionCenter.content.LECImprovementProposalFolder'] = proposalfolder
sys.modules['am.LiboExtensionCenter.content.LECProject'] = project
sys.modules['am.LiboExtensionCenter.content.LECRelease'] = release
sys.modules['am.LiboExtensionCenter.content.LECReleaseFolder'] = releasefolder

