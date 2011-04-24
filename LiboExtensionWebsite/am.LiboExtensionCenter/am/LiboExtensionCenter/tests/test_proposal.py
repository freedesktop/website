from base import LECTestCase

class TestProposal(LECTestCase):

    def afterSetUp(self):
        self.setRoles(('Manager',))
        self.portal.invokeFactory('LiboExtensionCenter', 'lec')
        self.portal.lec.invokeFactory('LECProject', 'proj')
        self.portal.lec.proj.invokeFactory('LECImprovementProposalFolder',
          'roadmap')
        self.portal.lec.proj.roadmap.invokeFactory(
          'LECImprovementProposal', '1')
        self.proposal = self.portal.lec.proj.roadmap['1']
    
    def testEditFields(self):
        self.proposal.setTitle('Custom Title')
        self.assertEqual('Custom Title', self.proposal.Title())
        
        self.proposal.setProposer('Me')
        self.assertEqual('Me', self.proposal.getProposer())
        
        self.proposal.setSeconder('You')
        self.assertEqual('You', self.proposal.getSeconder())
        
        self.proposal.setDescription('Custom Description')
        self.assertEqual('Custom Description', self.proposal.Description())
        
        self.proposal.setProposalTypes(['Type 1', 'Type 2'])
        self.assertEqual(('Type 1', 'Type 2'),
          self.proposal.getProposalTypes())
        
        self.proposal.setMotivation('To go boldly where no coder has gone '
          'before')
        self.assertEqual('To go boldly where no coder has gone before',
          self.proposal.getRawMotivation())
        
        self.proposal.setProposal('Beam me up, Limi.')
        self.assertEqual('Beam me up, Limi.', self.proposal.getRawProposal())
        
        self.proposal.setDefinitions('Plone: A CMS that rocks.')
        self.assertEqual('Plone: A CMS that rocks.',
          self.proposal.getRawDefinitions())
        
        self.proposal.setAssumptions('Community makes us who we are.')
        self.assertEqual('Community makes us who we are.',
          self.proposal.getRawAssumptions())
        
        self.proposal.setImplementation('Push the red button.')
        self.assertEqual('Push the red button.',
          self.proposal.getRawImplementation())
        
        self.proposal.setDeliverables('Beautiful code.')
        self.assertEqual('Beautiful code.',
          self.proposal.getRawDeliverables())
        
        self.proposal.setRisks('Beware falling anvils.')
        self.assertEqual('Beware falling anvils.',
          self.proposal.getRawRisks())
        
        self.proposal.setTimeline('Today: Plone. Tomorrow: The World!')
        self.assertEqual('Today: Plone. Tomorrow: The World!',
          self.proposal.getRawTimeline())
        
        self.proposal.setParticipants('Me and you.')
        self.assertEqual('Me and you.', self.proposal.getRawParticipants())
        
        self.proposal.setBranch('http://localhost/branch')
        self.assertEqual('http://localhost/branch', self.proposal.getBranch())
    
    def testSetBranch(self):
        self.proposal.setBranch('http://localhost/branch')
        self.assertEqual('http://localhost/branch', self.proposal.getBranch())
        
        self.proposal.setBranch('http://localhost/branch/ ')
        self.assertEqual('http://localhost/branch', self.proposal.getBranch())
    
    def testGetRelatedReleases(self):
        releases = self.portal.lec.proj.releases
        releases.invokeFactory('LECRelease', '1.0')
        releases.invokeFactory('LECRelease', '2.0')
        releases.invokeFactory('LECRelease', '3.0')
        
        releases['1.0'].setRelatedFeatures([self.proposal.UID()])
        releases['3.0'].setRelatedFeatures([self.proposal.UID()])
        
        self.assertEqual(['1.0', '3.0'], self.proposal.getRelatedReleases())
    
    def testGetProposalTypesVocab(self):
        self.portal.lec.proj.roadmap.setProposalTypes(['Type 1', 'Type 2'])
        self.assertEqual((('Type 1', 'Type 1'), ('Type 2', 'Type 2')),
          self.proposal.getProposalTypesVocab().items())
    
    def test_renameAfterCreation(self):
        roadmap = self.portal.lec.proj.roadmap
        
        self.failIf('2' in roadmap.objectIds())
        
        roadmap.invokeFactory('LECImprovementProposal', 'foo')
        roadmap.foo._renameAfterCreation()
        self.failUnless('2' in roadmap.objectIds())
    
    def testAllowedContentTypes(self):
        listTypeInfo = list(self.proposal.allowedContentTypes())
        types = [fti.id for fti in listTypeInfo]
        types.sort()
        self.assertEqual(['File', 'Image'], types)
    
class TestProposalView(LECTestCase):
    
    def afterSetUp(self):
        self.setRoles(('Manager',))
        self.portal.invokeFactory('LiboExtensionCenter', 'lec')
        self.portal.lec.invokeFactory('LECProject', 'proj')
        self.portal.lec.proj.invokeFactory('LECImprovementProposalFolder',
          'roadmap')
        self.portal.lec.proj.roadmap.invokeFactory(
          'LECImprovementProposal', '1')
        self.proposal = self.portal.lec.proj.roadmap['1']
        
        self.resetView()
    
    def resetView(self):
        self.view = self.proposal.restrictedTraverse('@@proposal_view')
        
    def testViewLookup(self):
        self.failIf(self.view is None)
        
    def testTitle(self):
        self.proposal.setTitle('Proposal 1')
        
        self.resetView()
        self.assertEqual('#1: Proposal 1', self.view.title())
    
    def test_raw_title(self):
        self.proposal.setTitle('Proposal 1')
        
        self.resetView()
        self.assertEqual('Proposal 1', self.view.raw_title())

def test_suite():
    from unittest import TestSuite, makeSuite
    suite = TestSuite()
    suite.addTest(makeSuite(TestProposal))
    suite.addTest(makeSuite(TestProposalView))
    return suite
