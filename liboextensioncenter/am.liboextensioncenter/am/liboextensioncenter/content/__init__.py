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

sys.modules['am.liboextensioncenter.content.liboextensioncenter'] = root
sys.modules['am.liboextensioncenter.content.PSCDocumentationFolder'] = docfolder
sys.modules['am.liboextensioncenter.content.PSCFile'] = downloadablefile
sys.modules['am.liboextensioncenter.content.PSCFileLink'] = filelink
sys.modules['am.liboextensioncenter.content.PSCImprovementProposal'] = proposal
sys.modules['am.liboextensioncenter.content.PSCImprovementProposalFolder'] = proposalfolder
sys.modules['am.liboextensioncenter.content.PSCProject'] = project
sys.modules['am.liboextensioncenter.content.PSCRelease'] = release
sys.modules['am.liboextensioncenter.content.PSCReleaseFolder'] = releasefolder

