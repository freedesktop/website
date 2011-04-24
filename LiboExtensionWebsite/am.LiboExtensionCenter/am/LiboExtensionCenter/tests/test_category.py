from base import LECTestCase


class TestCategoryView(LECTestCase):

    def afterSetUp(self):

        self.setRoles(('Manager',))

        self.portal.invokeFactory('LiboExtensionCenter', 'lec')

        self.lec = self.portal.lec

        for id in ['proj4', 'proj3', 'proj2', 'proj1']: 

            self.lec.invokeFactory('LECProject', id)

        self.lec.proj4.setCategories(['cat1'])
        self.lec.proj3.setCategories(['cat1'])
        self.lec.proj2.setCategories(['cat2'])
        self.lec.proj1.setCategories(['cat1','cat2'])
        self.lec.proj4.content_status_modify(workflow_action='publish')
        self.lec.proj3.content_status_modify(workflow_action='publish')
        self.lec.proj2.content_status_modify(workflow_action='publish')

        self.resetView()

    def resetView(self):
        self.view = self.lec.restrictedTraverse('@@category_view')

    def testViewLookup(self):
        self.failIf(self.view is None)
    
    def test_category_name(self):
        self.lec.setAvailableCategories([
          'cat1|Category 1|Projects of category 1',
          'cat2|Category 2|Projects of category 2',
          ])
        self.resetView()
        self.assertEqual(self.view.category_name('cat1'), 'Category 1' )
    
    def test_category_description(self):
        self.lec.setAvailableCategories([
          'cat1|Category 1|Projects of category 1',
          'cat2|Category 2|Projects of category 2',
          ])
        self.assertEqual(self.view.category_description('cat1'), 'Projects of category 1')

    def test_by_category(self):
        objs = [brain.getObject() for brain in self.view.by_category(
          'cat1')]
        objs.sort()
        for wanted in (self.lec.proj4, self.lec.proj3, self.lec.proj1):
            self.assert_(wanted in objs)

        objs = [brain.getObject() for brain in self.view.by_category(
          'cat1', states=['published',])]

        for wanted in (self.lec.proj4, self.lec.proj3):
            self.assert_(wanted in objs)
        
        objs = [brain.getObject() for brain in self.view.by_category(
          'cat1', limit=2)]
        objs.sort()
        for wanted in (self.lec.proj4, self.lec.proj3):
            self.assert_(wanted in objs)    
    
    def test_contained(self):

        objs = [brain.getObject() for brain in self.view._contained(
          category='cat1', portal_type='LECProject', states=['published'], sort_on='sortable_title')]
        self.assertEqual([self.lec.proj3, self.lec.proj4], objs)

        objs = [brain.getObject() for brain in self.view._contained(
          category='cat1', portal_type='LECProject', states=['published'])]
        
        for proj in (self.lec.proj4, self.lec.proj3):
            self.assert_(proj in objs)

        self.assertEqual([], self.view._contained(
          category='cat1', portal_type='DummyType', states=['published']))
        
        objs = [brain.getObject() for brain in self.view._contained(
          category='cat1', portal_type='LECProject', states=['published'], limit=2)]
        self.assertEqual([self.lec.proj3, self.lec.proj4],
          objs)
        
        objs = [brain.getObject() for brain in self.view._contained(
          category='cat1', portal_type='LECProject', states=['published'], sort_on='sortable_title', sort_order='reverse')]
        self.assertEqual([self.lec.proj3, self.lec.proj4], objs)

def test_suite():
    from unittest import TestSuite, makeSuite
    suite = TestSuite()
    suite.addTest(makeSuite(TestCategoryView))
    return suite
