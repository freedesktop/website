from am.LiboExtensionCenter.tests.base import LECTestCase
from am.LiboExtensionCenter.storage.interfaces import ILECFileStorage
from am.LiboExtensionCenter.storage.archetype import ArchetypeStorage
from am.LiboExtensionCenter.storage import getFileStorageVocab
from am.LiboExtensionCenter.storage import DynamicStorage
from am.LiboExtensionCenter.storage import getFileStorageAdapters

class TestStorage(LECTestCase):

    def afterSetUp(self):
        self.setRoles(('Manager',))
        self.portal.invokeFactory('LiboExtensionCenter', 'lec')
        self.portal.lec.invokeFactory('LECProject', 'proj')
        
        self.lec = self.portal.lec
        self.proj = self.portal.lec.proj
        releases = self.proj.releases 
        releases.invokeFactory('LECRelease', '1.0')
        self.release = releases['1.0']

    def test_adapters(self):
        # try various storage
        storage = DynamicStorage()
        self.assertEquals(storage.getName(), 'dynamic')
        
        pluggable_storage = storage._getStorage(self.lec)
        self.failUnless(pluggable_storage.__class__ is ArchetypeStorage)
        # name = pluggable_storage.getName()
        # self.assertEquals(name, 'archetype')

    def test_storage_vocab(self):
        """Test the test storage vocab"""
        vocab = getFileStorageVocab(self.release)
        found = False
        for index, title in vocab:
            if index == u'archetype' and title == "Archetypes (stores releases via Archetype's AttributeStorage)":
                found = True
                break
        self.assert_(found)
       
    def test_storage_change(self):

        # what is the current storage strategy ? 
        ss = self.portal.lec.getStorageStrategy()
        self.assertEquals(ss, 'archetype')

        # let's add a file to our project
        self.release.invokeFactory('LECFile', 'file')
        self.release.file.update(**{'title': 'my file'})

        # let's add a new strategy
        from zope.interface import implements
        class DummyStorage(object):
            title = u"Dummy"
            description = u"stores nothing"
            implements(ILECFileStorage)
            storage = []

            def __init__(self, context):
                self.context = context

            def set(self, *args, **kw):
                self.storage.append('ok')

        from zope.component import getSiteManager
        from zope.interface import Interface
        sm = getSiteManager()
        sm.registerAdapter(factory=DummyStorage, 
                           provided=ILECFileStorage,
                           required=(Interface,),
                           name='dummy')

        # let's see what kind of strategies are available
        strats = sorted([s for s, a in 
                  getFileStorageAdapters(self.portal.lec)])
        
        for s in ['archetype', 'dummy']:
            self.assert_(s in strats)

        # let's add some content in the file
        self.release.file.setDownloadableFile('xxxx')

        # let's change the strategy
        self.portal.lec.setStorageStrategy('dummy')

        # it should trigger an event that changes 
        # the storage for all files
        self.assert_(DummyStorage.storage, ['ok']) 
       
def test_suite():
    from unittest import TestSuite, makeSuite
    suite = TestSuite()
    suite.addTest(makeSuite(TestStorage))
    return suite
