.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _user-manual:

Users Manual
============

**Installation** `incl. Configuration` in **4** easy steps!
-------------------------------------------------

#. **Get the latest version of dm_simplecalendar from TER and install the extension with the extension manager**

   .. figure:: ../Images/UserManual/ExtensionManagerInstallExtension.png
      :alt: Extensionmanager Install Extension

   .


#. **Include the static templates [ SimpleCalendar | Default CSS ]**

   .. figure:: ../Images/UserManual/StaticTemplatesInclude.png
      :alt: StaticTemplates Include

   .

   - **OPTIONAL** set the ID of your calendar storage folder in constants to set default storage folder:

     .. code-block:: typoscript

       plugin.tx_dmcalendar.persistence.storagePid = ID


     (if you don't define a storage folder, the data will be saved on this page, where the calendar plugin is placed. You can also define different storage folder for each plugin in Tab “Behaviour”.)

#. **Go to a page where you want to insert a calendar plugin. Create a category item and then create an event item using list view.**

   - .. figure:: ../Images/UserManual/Pagetree.png
      :alt: Pagetree

   - .. figure:: ../Images/UserManual/CreateDataAppointmentCategory.png
      :alt: CreateDataAppointmentCategory

   - .. figure:: ../Images/UserManual/DataAppointmentCategory.png
      :alt: DataAppointmentCategory

   .


#. **Now create a new plugin and choose "DmSimpleCalendar"**

   Go through the settings, choose one or more categories and save the plugin.

   - .. figure:: ../Images/UserManual/PluginStart.png
      :alt: PluginStart
   
   .


**That's it!**

**Visit the page with the calendar plugin in the frontend, you see your first event shown in a calendar!**

.. _user-faq:

FAQ
---

Please use the `typo3 forge bug tracker <http://forge.typo3.org/projects/extension-dm_simplecalendar/issues>`_ or send an email to <salvatore.eckel@diemedialen.de> if you have a question what should be listet here.
