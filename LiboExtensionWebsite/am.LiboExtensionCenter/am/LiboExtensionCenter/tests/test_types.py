from base import LECTestCase

class TestInstantiation(LECTestCase):

    def testFullHierarchy(self):
        self.setRoles(('Manager',))
        
        try:
            self.portal.invokeFactory('LiboExtensionCenter', 'lec')
        except:
            self.fail('Failed to instantiate a LiboExtensionCenter')
        self.lec = self.portal.lec
        
        try:
            self.lec.invokeFactory('LECProject', 'proj')
        except:
            self.fail('Failed to instantiate a LECProject')
        self.proj = self.lec.proj
        
        self.failUnless('releases' in self.proj.objectIds())
        self.releases = self.proj.releases
        
        try:
            self.releases.invokeFactory('LECRelease', '1.0')
        except:
            self.fail('Failed to instantiate a LECRelease')
        self.release = self.releases['1.0']
        
        try:
            self.release.invokeFactory('LECFile', 'file')
        except:
            self.fail('Failed to instantiate a LECFile')
        try:
            self.release.invokeFactory('LECFileLink', 'link')
        except:
            self.fail('Failed to instantiate a LECFileLink')
        
        try:
            self.proj.invokeFactory('LECImprovementProposalFolder',
              'proposal_folder')
        except:
            self.fail('Failed to instantiate a LECImprovementProposalFolder')
        self.proposal_folder = self.proj.proposal_folder
        try:
            self.proposal_folder.invokeFactory('LECImprovementProposal', '1')
        except:
            self.fail('Failed to instantiate a LECImprovementProposal')
        self.proposal = self.proposal_folder['1']
        try:
            self.proposal.invokeFactory('File', 'file')
        except:
            self.fail('Failed to insantiate a file inside an improvement '
              'proposal')
        try:
            self.proposal.invokeFactory('Image', 'image')
        except:
            self.fail('Failed to insantiate an image inside an improvement '
              'proposal')
        
        try:
            self.proj.invokeFactory('LECDocumentationFolder', 'docs')
        except:
            self.fail('Failed to instantiate a LECDocumentationFolder')
            
def test_suite():
    from unittest import TestSuite, makeSuite
    suite = TestSuite()
    suite.addTest(makeSuite(TestInstantiation))
    return suite
