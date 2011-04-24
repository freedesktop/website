from base import LECTestCase

class TestReleaseFolder(LECTestCase):

    def afterSetUp(self):
        self.setRoles(('Manager',))
        self.portal.invokeFactory('LiboExtensionCenter', 'lec')
        self.portal.lec.invokeFactory('LECProject', 'proj')
        
        self.lec = self.portal.lec
        self.proj = self.portal.lec.proj
        self.releases = self.lec.proj.releases
    
    def testEditFields(self):
        self.releases.setTitle('Custom Releases Title')
        self.assertEqual('Custom Releases Title', self.releases.Title())
        
        self.releases.setDescription('Custom Releases Description')
        self.assertEqual('Custom Releases Description',
          self.releases.Description())
    
    def test_renameAfterCreation(self):
        self.proj.manage_delObjects(['releases'])
        self.proj.invokeFactory('LECReleaseFolder', 'foo')
        self.proj.foo._renameAfterCreation()
        self.failUnless('releases' in self.proj.objectIds())
    
    def testGenerateUniqueId(self):
        self.assertEqual('1.0', self.releases.generateUniqueId('LECRelease'))
        
        self.releases.invokeFactory('LECRelease', '1.0')
        self.assertEqual('1.1', self.releases.generateUniqueId('LECRelease'))

class TestReleaseFolderView(LECTestCase):
    
    def afterSetUp(self):
        self.setRoles(('Manager',))
        self.portal.invokeFactory('LiboExtensionCenter', 'lec')
        self.portal.lec.invokeFactory('LECProject', 'proj')
        self.releases = self.portal.lec.proj.releases
        
        for ver in ['1.0', '2.0', '3.0', '4.0', '5.0']:
            self.releases.invokeFactory('LECRelease', ver)
        
        self.releases['2.0'].content_status_modify(workflow_action = 'release-alpha')
        self.releases['3.0'].content_status_modify(workflow_action = 'release-final')
        self.releases['4.0'].content_status_modify(workflow_action = 'release-beta')
        self.releases['5.0'].content_status_modify(workflow_action = 'release-final')
        
        self.resetView()
    
    def resetView(self):
        self.view = self.releases.restrictedTraverse('@@releasefolder_view')
    
    def testViewLookup(self):
        self.failIf(self.view is None)
        
    def test_upcoming_releases(self):
        objs = self.view.upcoming_releases()
        #Alpha, beta, and relase-candidates come in order; then
        #pre-releases come at end
        self.assertEqual([self.releases['2.0'], self.releases['4.0'],
          self.releases['1.0']], objs)
    
    def test_previous_releases(self):
        objs = self.view.previous_releases()
        #Final releases come in reverse order
        self.assertEqual([self.releases['5.0'], self.releases['3.0']], objs)
            
def test_suite():
    from unittest import TestSuite, makeSuite
    suite = TestSuite()
    suite.addTest(makeSuite(TestReleaseFolder))
    suite.addTest(makeSuite(TestReleaseFolderView))
    return suite
