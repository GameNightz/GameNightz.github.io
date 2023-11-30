let allEvents = [];
let allMonths = ["Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"];
let allBookings = []; // Alle Events die der angemeldete Benutzer gebucht hat

function createEvent(_title, _date, _time, _tags)
{
  allEvents.push(new Event(_title, _date, _time, _tags)); // fügt das Event dem Event-array hinzu
  // löscht alle Events, die älter "heute" sind
  for (let _i = allEvents.length - 1; _i >= 0; _i--)
  {
    let _currentDate = new Date();
    if (allEvents[_i].date[2] < _currentDate.getFullYear() || (allEvents[_i].date[2] == _currentDate.getFullYear() && allEvents[_i].date[1] - 1 < _currentDate.getMonth()) || (allEvents[_i].date[2] == _currentDate.getFullYear() && allEvents[_i].date[1] - 1 == _currentDate.getMonth() && allEvents[_i].date[0] < _currentDate.getDate())) allEvents.splice(_i, 1);
  }
  // sortiert die Events (nach Datum) aufsteigend
  allEvents.sort(function(a, b)
  {
    if (a.date[2] != b.date[2]) return a.date[2] - b.date[2];
    else if (a.date[1] != b.date[1]) return a.date[1] - b.date[1];
    else if (a.date[0] != b.date[0]) return a.date[0] - b.date[0];
    0;
  });
  loadAllEvents();
}

function loadAllEvents()
{
  document.querySelector(".calendar-container").innerHTML = ""; // löscht alle Events (auf der Website) - Events sind aber noch im Array gespeichert
  for (let _event of allEvents)
  {
    addEvent(_event);
  }
}

function addEvent(_event) // fügt die Event-karte dem HTML-dokument zu
{
  addYear(_event.date);
  addMonth(_event.date);
  document.querySelector("[data-year=\"year" + _event.date[2].toString() + "\"]").querySelector("[data-month=\"month" + (_event.date[1] - 1).toString() + "\"]").querySelector(".month-content").innerHTML += _event.getHtml();
}

function addMonth(_date) // fügt neuen Monat (in dem Jahr aus "_date") hinzu (Titel und Feld für Event-karten)
{
  if (!document.querySelector("[data-year=\"year" + _date[2].toString() + "\"]").querySelector("[data-month=\"month" + (_date[1] - 1).toString() + "\"]")) document.querySelector("[data-year=\"year" + _date[2].toString() + "\"]").innerHTML += "<div class=\"month-container\" data-month=\"month" + (_date[1] - 1).toString() + "\"><div class=\"month-title\">" + allMonths[_date[1] - 1] + " " + _date[2] + "</div><div class=\"month-content\"></div></div>";
}

function addYear(_date) // fügt neues Jahr hinzu (Feld für Monate)
{
  if (!document.querySelector("[data-year=\"year" + _date[2].toString() + "\"]")) document.querySelector(".calendar-container").innerHTML += "<div class=\"year-container\" data-year=\"year" + _date[2].toString() + "\"></div>";
}

function openEventDetails(_eventEntry)
{
  let _eventDetailContainer = document.querySelector(".event-details-container");
  _eventDetailContainer.style.display = "block";
  let _selectedEvent;
  for (let _event of allEvents)
  {
    if (_event.isEventWith(_eventEntry.attributes["data-title"].value, _eventEntry.attributes["data-date"].value, _eventEntry.attributes["data-time"].value))
    {
      _selectedEvent = _event;
      break;
    }
  }
  _eventDetailContainer.querySelector(".event-title").innerHTML = _selectedEvent.title;
  _eventDetailContainer.querySelector(".event-date").innerHTML = _selectedEvent.dateToString();
  _eventDetailContainer.querySelector(".event-time").innerHTML = _selectedEvent.timeToString();
}

function closeEventDetails()
{
  document.querySelector(".event-details-container").style.display = "none";
}

class Event
{
  constructor(_title, _date, _time, _tags) // title: String, date: [*day*, *month*, *year*], imagePath: String
  {
    this.title = _title;
    this.date = _date;
    this.time = _time;
    this.imagePath = "../Images/Image1.jpg";
    this.html;
  }
  getHtml() // der HTML eintrag für diese Event-karte
  {
    return "<div class=\"event-entry\" data-title=\"" + this.title + "\" data-date=\"" + this.date + "\" data-time=\"" + this.time + "\" onclick=\"openEventDetails(this)\"><img src=" + this.imagePath + "><div class=\"event-content\">" + this.dateToString() + "<br>" + this.title + "</div>";
  }
  dateToString()
  {
    return (this.date[0].toString() + ". " + allMonths[this.date[1] - 1] + " " + this.date[2].toString());
  }
  timeToString()
  {
    return (this.time[0] + ":" + this.time[1]);
  }
  isEventWith(_title, _date, _time)
  {
    return (this.title == _title && this.date == _date && this.time == _time);
  }
}