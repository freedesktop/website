from zope.interface import implements
from zope.component import adapts

from Products.Archetypes.atapi import AttributeStorage

from am.LiboExtensionCenter.storage.interfaces import ILECFileStorage
from Products.Archetypes.interfaces.storage import IStorage

class ArchetypeStorage(AttributeStorage):
    """adapts a release folder as a dummy storage
    """ 
    implements(ILECFileStorage)

    title = u"Archetypes"
    description = u"stores releases via Archetype's AttributeStorage"
    
    def __init__(self, context):
        self.context = context


