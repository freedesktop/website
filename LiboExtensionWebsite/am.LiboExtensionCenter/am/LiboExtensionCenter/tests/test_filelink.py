from base import LECTestCase

class TestLECFileLink(LECTestCase):

    def afterSetUp(self):
        self.setRoles(('Manager',))
        self.portal.invokeFactory('LiboExtensionCenter', 'lec')
        self.portal.lec.invokeFactory('LECProject', 'proj')
        self.portal.lec.proj.releases.invokeFactory('LECRelease', '1.0')
        self.portal.lec.proj.releases['1.0'].invokeFactory('LECFileLink',
          'filelink')
        self.filelink = self.portal.lec.proj.releases['1.0'].filelink
    
    def testEditFields(self):
        self.filelink.setTitle('Custom Title')
        self.assertEqual('Custom Title', self.filelink.Title())
        
        self.filelink.setPlatform('Platform 1')
        self.assertEqual('Platform 1', self.filelink.getPlatform())
        
        self.filelink.setExternalURL('http://nohost')
        self.assertEqual('http://nohost', self.filelink.getExternalURL())
        
        self.filelink.setExternalFileSize('10 MB')
        self.assertEqual('10 MB', self.filelink.getExternalFileSize())
    
    def testGetPlatformVocab(self):
        self.portal.lec.setAvailablePlatforms(['Platform 1', 'Platform 2'])
        self.assertEqual((('Platform 1', 'Platform 1'), ('Platform 2',
          'Platform 2')), self.filelink.getPlatformVocab().items())
    
class TestLECFileLinkView(LECTestCase):
    
    def afterSetUp(self):
        self.setRoles(('Manager',))
        self.portal.invokeFactory('LiboExtensionCenter', 'lec')
        self.portal.lec.invokeFactory('LECProject', 'proj')
        self.portal.lec.proj.releases.invokeFactory('LECRelease', '1.0')
        self.portal.lec.proj.releases['1.0'].invokeFactory('LECFileLink',
          'filelink')
        self.filelink = self.portal.lec.proj.releases['1.0'].filelink
        
        self.resetView()
    
    def resetView(self):
        self.view = self.filelink.restrictedTraverse('@@file_view')
        
    def testViewLookup(self):
        self.failIf(self.view is None)
        
    def test_downloadicon_name(self):
        self.filelink.setPlatform('Test OS')
        
        self.resetView()
        self.assertEqual('platform_test_os.gif',
          self.view.downloadicon_name())
    
    def test_file_size(self):
        self.filelink.setExternalFileSize('10 MB')
        
        self.resetView()
        self.assertEqual('10 MB', self.view.file_size())
    
    def test_direct_url(self):
        self.filelink.setExternalURL('http://nohost')
        
        self.resetView()
        self.assertEqual('http://nohost', self.view.direct_url())

def test_suite():
    from unittest import TestSuite, makeSuite
    suite = TestSuite()
    suite.addTest(makeSuite(TestLECFileLink))
    suite.addTest(makeSuite(TestLECFileLinkView))
    return suite
