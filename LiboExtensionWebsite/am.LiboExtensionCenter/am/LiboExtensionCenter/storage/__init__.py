from zope.component import getAdapter
from zope.component import getAdapters
from Acquisition import aq_parent

from am.LiboExtensionCenter.storage.interfaces import ILECFileStorage


class DynamicStorage(object):
    """This storage will trigger the right kind of storage
    given the user settings at root level"""

    def get(self, name, instance, **kwargs):
        # XXX Can we do this for now to get through a catalog clear and rebuild ? 
        try:
            return self._getStorage(instance).get(name, instance, **kwargs)
        except:
            pass

    def set(self, name, instance, value, **kwargs):
        return self._getStorage(instance).set(name, instance, value, **kwargs)

    def unset(self, name, instance, **kwargs):
        return self._getStorage(instance).get(name, instance, **kwargs)

    def getName(self):
        return 'dynamic'

    def _getStorage(self, instance):
        """returns the storage name, which is stored at LEC level"""
        # XXX crawl back up - what if the node in not in a LEC instance ?
        # need a better code here
        from am.LiboExtensionCenter.content.root import LiboExtensionCenter

        lec = instance
        while not isinstance(lec, LiboExtensionCenter) and lec is not None:
            # Walk up the acquisition chain to the
            # LiboExtensionCenter.  Note: in the context of browser
            # views the acquisition chain of the context is: context,
            # browser view, context, real parent of context.  So the
            # context is its own grandparent.
            lec = aq_parent(lec)

        if lec is None:
            # Should Not Happen (TM)
            raise Exception("No LiboExtensionCenter found in acquisition "
                            "chain of %r." % instance)
        name = lec.getStorageStrategy()
        return getAdapter(lec, ILECFileStorage, name)


def getFileStorageAdapters(context):
    return getAdapters((context, ), ILECFileStorage)


def getFileStorageVocab(context):
    """Return a vocab for the lec edit form.

    Should probably go on a view somewhere eventually"""
    adapters = getFileStorageAdapters(context)
    return [(name, "%s (%s)" % (storage.title, storage.description))
            for name, storage in adapters]
