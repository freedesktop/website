"""Base class for integration tests, based on ZopeTestCase and PloneTestCase.

Note that importing this module has various side-effects: it registers a set of
products with Zope, and it sets up a sandbox Plone site with the appropriate
products installed.
"""
import warnings
import os

from Testing import ZopeTestCase

ZopeTestCase.installProduct('ArchAddOn')
ZopeTestCase.installProduct('AddRemoveWidget')
ZopeTestCase.installProduct('DataGridField')
ZopeTestCase.installProduct('ExternalStorage')
# If PloneHelpCenter is available, initialize it.
ZopeTestCase.installProduct('PloneHelpCenter')

from Products.PloneTestCase.PloneTestCase import PloneTestCase
from Products.PloneTestCase.PloneTestCase import FunctionalTestCase
from Products.PloneTestCase.PloneTestCase import setupPloneSite

from Products.Five import fiveconfigure
from Products.Five import zcml

from Products.PloneTestCase.layer import onsetup
from Products.PloneTestCase.layer import PloneSite

@onsetup
def install_plugins():
    ZopeTestCase.installPackage('collective.lec.externalstorage')

install_plugins()
setupPloneSite(products=['am.LiboExtensionCenter',])

class DeveloperWarning(Warning):
    pass

def developer_warning(msg):
    warnings.warn(msg, DeveloperWarning)

class LECTestCase(PloneTestCase):
    """Base class for integration tests
    """
    def warning(self, msg):
        developer_warning(msg)

    class layer(PloneSite):
        @classmethod
        def setUp(cls):
            import am.LiboExtensionCenter
            fiveconfigure.debug_mode = True
            zcml.load_config('configure.zcml', am.LiboExtensionCenter)
    
            # loading externalstorage if present in the environment
            try:
                import collective.lec.externalstorage
            except ImportError:
                pass
            else:
                ext = os.path.dirname(collective.lec.externalstorage.__file__)
                config = os.path.join(ext, 'configure.zcml')
                zcml.load_config(config,
                                 collective.lec.externalstorage)
                from zope.component import getGlobalSiteManager
                from collective.lec.externalstorage.config import ESConfiguration
                from collective.lec.externalstorage.interfaces import IESConfiguration
                gsm = getGlobalSiteManager()
                gsm.registerUtility(ESConfiguration, IESConfiguration)

            fiveconfigure.debug_mode = False

        @classmethod
        def tearDown(cls):
            pass

class LECFunctionalTestCase(FunctionalTestCase):
    """Base class for functional integration tests
    """
