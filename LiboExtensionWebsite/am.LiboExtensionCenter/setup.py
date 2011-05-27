from setuptools import setup, find_packages
import os

version = '1.0'

setup(name='am.LiboExtensionCenter',
      version=version,
      description="A extension center for LibreOffice",
      long_description=open("README.txt").read() + "\n" +
                       open(os.path.join("docs", "HISTORY.txt")).read(),
      # Get more strings from
      # http://pypi.python.org/pypi?:action=list_classifiers
      classifiers=[
        "Framework :: Plone",
        "Framework :: Zope2",
        "Framework :: Zope3",
        "Programming Language :: Python",
        "Topic :: Software Development :: Libraries :: Python Modules",
        ],
      keywords='Plone LibreOffice Extensions',
      author='Andreas Mantke',
      author_email='maand@gmx.de',
      url='http://svn.plone.org/svn/collective/',
      license='GPL',
      packages=find_packages(exclude=['ez_setup']),
      namespace_packages=['am'],
      include_package_data=True,
      zip_safe=False,
      install_requires=[
          'setuptools',
          # -*- Extra requirements: -*-
          'Products.ArchAddOn',
          'Products.AddRemoveWidget',
          'Products.DataGridField',
          'cioppino.twothumbs',
          # this is temporary until we get the ratings migrated
          'plone.contentratings',
      ],
      entry_points="""
      # -*- Entry points: -*-

      [z3c.autoinclude.plugin]
      target = plone
      """,
      setup_requires=["PasteScript"],
      paster_plugins=["ZopeSkel"],
      )
