"use strict";
!(function (l) {
  function CalendarApp() {
    this.$body = l("body");
    this.$modal = l("#event-modal");
    this.$calendar = l("#calendar");
    this.$formEvent = l("#form-event");
    this.$btnNewEvent = l("#btn-new-event");
    this.$btnDeleteEvent = l("#btn-delete-event");
    this.$btnSaveEvent = l("#btn-save-event");
    this.$modalTitle = l("#modal-title");
    this.$calendarObj = null;
    this.$selectedEvent = null;
    this.$newEventData = null;
  }

  CalendarApp.prototype.onEventClick = function (e) {
    this.$formEvent[0].reset();
    this.$formEvent.removeClass("was-validated");
    this.$newEventData = null;
    this.$btnDeleteEvent.show();
    this.$modalTitle.text("Edit Event");
    this.$modal.modal("show");
    this.$selectedEvent = e.event;
    l("#event-title").val(this.$selectedEvent.title);
    l("#event-category").val(this.$selectedEvent.classNames[0]);
  };

  CalendarApp.prototype.onSelect = function (e) {
    this.$formEvent[0].reset();
    this.$formEvent.removeClass("was-validated");
    this.$selectedEvent = null;
    this.$newEventData = e;
    this.$btnDeleteEvent.hide();
    this.$modalTitle.text("Add New Event");
    this.$modal.modal("show");
    this.$calendarObj.unselect();
  };

  CalendarApp.prototype.init = function (events) {
    var todayDate = new Date();
    var a = this;
    this.$calendarObj = new FullCalendar.Calendar(this.$calendar[0], {
      slotDuration: "00:15:00",
      slotMinTime: "08:00:00",
      slotMaxTime: "19:00:00",
      themeSystem: "bootstrap",
      bootstrapFontAwesome: false,
      buttonText: {
        today: "Today",
        month: "Month",
        week: "Week",
        day: "Day",
        list: "List",
        prev: "Prev",
        next: "Next",
      },
      initialView: "dayGridMonth",
      handleWindowResize: true,
      height: l(window).height() - 200,
      headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth",
      },
      initialEvents: events,
      editable: true,
      droppable: true,
      selectable: true,
      dateClick: function (e) {
        a.onSelect(e);
      },
      eventClick: function (e) {
        a.onEventClick(e);
      },
    });
    this.$calendarObj.render();
    this.$btnNewEvent.on("click", function (e) {
      a.onSelect({ date: new Date(), allDay: true });
    });
    this.$formEvent.on("submit", function (e) {
      e.preventDefault();
      var form = this;
      if (form.checkValidity()) {
        if (a.$selectedEvent) {
          a.$selectedEvent.setProp("title", l("#event-title").val());
          a.$selectedEvent.setProp("classNames", [l("#event-category").val()]);
        } else {
          var newEvent = {
            title: l("#event-title").val(),
            start: a.$newEventData.date,
            allDay: a.$newEventData.allDay,
            className: l("#event-category").val(),
          };
          a.$calendarObj.addEvent(newEvent);
        }
        a.$modal.modal("hide");
      } else {
        e.stopPropagation();
        form.classList.add("was-validated");
      }
    });
    this.$btnDeleteEvent.on("click", function (e) {
      if (a.$selectedEvent) {
        a.$selectedEvent.remove();
        a.$selectedEvent = null;
        a.$modal.modal("hide");
      }
    });
  };

  // Expose the CalendarApp globally
  l.CalendarApp = new CalendarApp();
})(window.jQuery);
