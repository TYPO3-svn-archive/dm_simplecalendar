.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _developer:

Developer Corner
================

In the developer corner, you can learn the basics for templating with ``dm_simplecalendar``

The Template System requires two main templates

- `Templates/Calendar/Show.html`
  
  For displaying calendar, mainly uses the variable ``{viewCalendar}``

- Templates/Appointment/Show.html
  
  For displaying appointment detail view, mainly uses the variable ``{appointment}``

How to build a calendar
-----------------------

Introduction
^^^^^^^^^^^^

The Template ``Templates/Calendar/Show.html`` just should redirect to the needed **Partials**

.. code-block:: html

	<f:layout name="Simplecalendar" />

	<f:section name="main">

	    <f:flashMessages renderMode="div" />

	    <f:if condition="{viewCalendar.mode} == 'year'">
	        <f:then>
	            <f:render partial="Calendar/YearCalendar" arguments="{viewCalendar:viewCalendar}" />
	        </f:then>
	    </f:if>
	    <f:if condition="{viewCalendar.mode} == 'month'">
	        <f:then>
	            <f:render partial="Calendar/MonthCalendar" arguments="{viewCalendar:viewCalendar}" />
	        </f:then>
	    </f:if>
	    <f:if condition="{viewCalendar.mode} == 'week'">
	        <f:then>
	            <f:render partial="Calendar/WeekCalendar" arguments="{viewCalendar:viewCalendar}" />
	        </f:then>
	    </f:if>
	    <f:if condition="{viewCalendar.mode} == 'day'">
	        <f:then>
	            <f:render partial="Calendar/DayCalendar" arguments="{viewCalendar:viewCalendar}" />
	        </f:then>
	    </f:if>

	</f:section>

Required ViewHelpers to build a calendar
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

**Include** ``{namespace dmc=DieMedialen\DmSimplecalendar\ViewHelpers}`` **on top of every template and partial to use the following ViewHelpers**

.. code-block:: html

	<dmc:renderAsMonthCalendars viewCalendar="{viewCalendar}" as="monthCalendar"><!-- LOOP --></dmc:renderAsMonthCalendars>

.. code-block:: html

	<dmc:renderAsWeekCalendars viewCalendar="{viewCalendar}" as="weekCalendar"><!-- LOOP --></dmc:renderAsWeekCalendars>

.. code-block:: html

	<dmc:renderAsDayCalendars viewCalendar="{viewCalendar}" as="dayCalendar"><!-- LOOP --></dmc:renderAsDayCalendars>

Simple HTML Example to display a full year!
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Lets say, you choose **year** as dispaly mode in plugin, the property ``{viewCalendar.mode}`` will be "year".

.. code-block:: html

	<div class="yearItem">

		<f:format.date format="Y">{viewCalendar.timestamp}</f:format.date> <!-- 2014 -->

		<!-- Iterates 12 times, return every loop a monthCalendar -->
		<dmc:renderAsMonthCalendars viewCalendar="{viewCalendar}" as="monthCalendar">

		<div class="monthItem">

			<f:format.date format="F">{viewCalendar.timestamp}</f:format.date> <!-- January, February, March.. -->

			<!-- Iterates 4-5 times, return every loop a weekCalenar -->
			<dmc:renderAsWeekCalendars viewCalendar="{monthCalendar}" as="weekCalendar">

			<div class="weekItem">

				<!-- Iterates 7 times, return every loop a dayCalenar -->
				<dmc:renderAsDayCalendars viewCalendar="{weekCalendar}" as="dayCalendar">

				<div class="dayItem">

					<f:format.date format="d.m.Y H:m:s">{dayCalendar.timestamp}</f:format.date> <!-- 01.01.2014, 02.01.2014, 03.01.2014.. -->

				</div>

				</dmc:renderAsDayCalendars>

			</div>

			</dmc:renderAsWeekCalendars>

		</div>

		</dmc:renderAsMonthCalendars>

	</div>

The generated HTML Code will be:

.. code-block:: html

	<div class="yearItem">

		2014

		<div class="monthItem">

			January

			<div class="weekItem">

				<div class="dayItem">30.12.2013</div>
				<div class="dayItem">31.12.2013</div>
				<div class="dayItem">01.01.2014</div>
				<div class="dayItem">02.01.2014</div>
				<div class="dayItem">......</div>
				...

			</div>

			<div class="weekItem">

				<div class="dayItem">06.01.2014</div>
				...

			</div>

			...

		</div>

		<div class="monthItem">

			February

			<div class="weekItem">

				...
				<div class="dayItem">02.02.2014</div>
				<div class="dayItem">03.02.2014</div>
				...

			</div>

			<div class="weekItem">

				<div class="dayItem">06.01.2014</div>
				...

			</div>

			...
			...

		</div>

	</div>


You may ask, why the first days in January are "30.12.2013" and "31.12.2013". This comes, because we rendered the ``{monthCalendar}`` to ``{weekCalendar}`` and then to ``{dayCalendar}``. A week has always 7 days, so the pre-month days are shown. If you render the ``{monthCalendar}`` directly to an ``{dayCalendar}``, there will be only ``{dayCalendar}`` in loop, what are realy in the month!

Main Variables
--------------

``{viewCalendar}``
^^^^^^^^^^^^^^^^^

``DieMedialen\DmSimplecalendar\Domain\Model\ViewCalendar``

+---------------------+------------------------------------------------------------------------------------+-----------------------------+
| Properties          | Type                                                                               | Description                 |
+=====================+====================================================================================+=============================+
| timestamp           | integer                                                                            | timestamp of current        |
|                     |                                                                                    | calendar                    |
+---------------------+------------------------------------------------------------------------------------+-----------------------------+
| mode                | string                                                                             | year/month/week/day         |
+---------------------+------------------------------------------------------------------------------------+-----------------------------+
| appointments        | ``TYPO3\CMS\Extbase\Persistence\ObjectStorage<``                                   |                             |
|                     |                                                                                    |                             |
|                     | ``DieMedialen\DmSimplecalendar\Domain\Model\Appointment``                          |                             |
|                     |                                                                                    |                             |
|                     | ``>``                                                                              |                             |
+---------------------+------------------------------------------------------------------------------------+-----------------------------+
| previous            | integer                                                                            | timestamp of previous       |
|                     |                                                                                    | calendar of same mode       |
+---------------------+------------------------------------------------------------------------------------+-----------------------------+
| next                | integer                                                                            | timestamp of next           |
|                     |                                                                                    | calendar of same mode       |
+---------------------+------------------------------------------------------------------------------------+-----------------------------+
| uid                 | integer                                                                            |                             |
+---------------------+------------------------------------------------------------------------------------+-----------------------------+
| pid                 | integer                                                                            |                             |
+---------------------+------------------------------------------------------------------------------------+-----------------------------+


``{appointment}``
^^^^^^^^^^^^^^^^^

``DieMedialen\DmSimplecalendar\Domain\Model\Appointment``

+---------------------+------------------------------------------------------------------------------------+-----------------------------+
| Properties          | Type                                                                               | Description                 |
+=====================+====================================================================================+=============================+
| media               | ``DieMedialen\DmSimplecalendar\Domain\Model\Media``                                | Model with 2 FAL properties |
|                     |                                                                                    | Unlimited attachments       |
+---------------------+------------------------------------------------------------------------------------+-----------------------------+
| categories          | ``TYPO3\CMS\Extbase\Persistence\ObjectStorage<``                                   |                             |
|                     |                                                                                    |                             |
|                     | ``DieMedialen\DmSimplecalendar\Domain\Model\Category``                             |                             |
|                     |                                                                                    |                             |
|                     | ``>``                                                                              |                             |
+---------------------+------------------------------------------------------------------------------------+-----------------------------+
| location            | string                                                                             | Use for city, name of       |
|                     |                                                                                    | organisation or something   |
+---------------------+------------------------------------------------------------------------------------+-----------------------------+
| description         | string                                                                             | The main description text   |
+---------------------+------------------------------------------------------------------------------------+-----------------------------+
| shortdescription    | string                                                                             | A short teaser text         |
+---------------------+------------------------------------------------------------------------------------+-----------------------------+
| startdate           | DateTime                                                                           | StartDate of appointment    |
+---------------------+------------------------------------------------------------------------------------+-----------------------------+
| enddate             | DateTime                                                                           | EndDate of appointment      |
+---------------------+------------------------------------------------------------------------------------+-----------------------------+
| title               | string                                                                             | The appointments title      |
+---------------------+------------------------------------------------------------------------------------+-----------------------------+
| uid                 | integer                                                                            |                             |
+---------------------+------------------------------------------------------------------------------------+-----------------------------+
| pid                 | integer                                                                            |                             |
+---------------------+------------------------------------------------------------------------------------+-----------------------------+

``{appointment.media}``
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``DieMedialen\DmSimplecalendar\Domain\Model\Media``

+---------------------+------------------------------------------------------------------------------------+-----------------------------+
| Properties          | Type                                                                               | Description                 |
+=====================+====================================================================================+=============================+
| files               | string                                                                             | FAL resources               |
+---------------------+------------------------------------------------------------------------------------+-----------------------------+
| images              | string                                                                             | FAL resources               |
+---------------------+------------------------------------------------------------------------------------+-----------------------------+
| uid                 | integer                                                                            |                             |
+---------------------+------------------------------------------------------------------------------------+-----------------------------+
| pid                 | integer                                                                            |                             |
+---------------------+------------------------------------------------------------------------------------+-----------------------------+

``{appointment.categories}``
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``TYPO3\CMS\Extbase\Persistence\ObjectStorage<DieMedialen\DmSimplecalendar\Domain\Model\Category>``

+---------------------+------------------------------------------------------------------------------------+-----------------------------+
| Properties          | Type                                                                               | Description                 |
+=====================+====================================================================================+=============================+
| title               | string                                                                             |                             |
+---------------------+------------------------------------------------------------------------------------+-----------------------------+
| color               | string                                                                             | you can use strings or      |
|                     |                                                                                    | HEX code for coloring       |
+---------------------+------------------------------------------------------------------------------------+-----------------------------+
| uid                 | integer                                                                            |                             |
+---------------------+------------------------------------------------------------------------------------+-----------------------------+
| pid                 | integer                                                                            |                             |
+---------------------+------------------------------------------------------------------------------------+-----------------------------+


Navigation and Links in calendar templates
------------------------------------------

#. Generate a link to an appointment detail view:

   .. code-block:: typoscript

   	<f:link.action action="show" controller="Appointment" arguments="{appointment:appointment}">{appointment.title}</f:link.action>

   The ACTION must be ``show``, the CONTROLLER must be ``Appointment`` and an ``appointment`` must be given in ARGUMENTS

#. Generate a prev/next link to navigate through your calendar

   .. code-block:: typoscript

   	<f:link.action action="show" controller="Calendar" arguments="{viewTimestamp: viewCalendar.previous, viewMode: viewCalendar.mode}">PREV</f:link.action>

   The ACTION must be ``show``, the CONTROLLER must be ``Calendar`` and a ``viewTimestamp`` and a ``viewMode`` must be given in ARGUMENTS


Tutorials / Examples
--------------------

Limit the number of listed appointments
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To limit the displayed appointments, you can use the setting ``{settings.appointmentAmountLimit}``.

You can define this setting in each calendar-plugin in tab "Template" or you can define the setting in TypoScript-Setup:

.. code-block:: typoscript

	plugin.tx_dmsimplecalendar {
	    settings {
	        appointmentAmountLimit = 3
	    }
	}

.. code-block:: html

	...

	<dmc:renderAsDayCalendars viewCalendar="{weekCalendar}" as="dayCalendar">

	    <f:if condition="{dayCalendar.appointments -> f:count()} > 0">

	    <f:then>

	        <f:for each="{dayCalendar.appointments}" as="appointment" iteration="appointmentIterator">

	            <f:if condition="{appointmentIterator.index} < {settings.appointmentAmountLimit}">

	                <f:link.action action="show" controller="Appointment" arguments="{appointment:appointment}">{appointment.title}</f:link.action>

	            </f:if>

	        </f:for>

	        <f:if condition="{dayCalendar.appointments -> f:count()} > {settings.appointmentAmountLimit}">

	            <f:link.action action="show" controller="Calendar" arguments="{viewTimestamp: dayCalendar.timestamp, viewMode: dayCalendar.mode}">...</f:link.action>

	        </f:if>

	    </f:then>

	    <f:else>

	        <p>{f:translate(key:'tx_dmsimplecalendar_view_appointment_none',default:'')}</p>

	    </f:else>

	    </f:if>

	</dmc:renderAsDayCalendars>

	...

