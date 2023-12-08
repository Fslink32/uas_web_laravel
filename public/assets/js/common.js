var App;
if (!window.console) {
  var console = {
    log: function() {},
    warn: function() {},
    error: function() {},
    time: function() {},
    timeEnd: function() {}
  };
}
var log = function() {};

require.config({
  paths: {
    jQuery: "../../plugins/jquery/jquery.min",
    jQueryUI: "../../plugins/jquery-ui/jquery-ui.min",
    nouislider: "../../plugins/nouislider/nouislider.min",
    tablerMaster: "../../plugins/tabler/js/tabler.min",
    tabler: "../../plugins/tabler/js/demo",
    jValidate: "../../plugins/jquery-validate/jquery.validate.min",
    datatables:
      "../../plugins/datatables/DataTables-1.12.1/js/jquery.dataTables.min",
    datatablesBootstrap:
      "../../plugins/datatables/DataTables-1.12.1/js/dataTables.bootstrap5.min",
    datatablesResponsive:
      "../../plugins/datatables/Responsive-2.3.0/js/dataTables.responsive.min",
    select2: "../../plugins/select2/js/select2.min",
    flatPicker: "../../plugins/flatpicker/flatpickr.min",
    flatPickerLocale: "../../plugins/flatpicker/l10n/id",
    flatPickerMonthSelect: "../../plugins/flatpicker/plugins/monthSelect/index",
    bootstrapDatePicker:
      "../../plugins/bootstrap-datepicker/bootstrap-datepicker.min",
    toastr: "../../plugins/toastr/toastr.min",
    moment: "../../plugins/moment/moment.min",
    tinymce: "../../plugins/tinymce/tinymce.min",
    tinymceLocale: "../../plugins/tinymce/langs/id",
    dropzone: "../../plugins/dropzone/dropzone.min",
    waypoint: "../../plugins/counterUp/jquery.waypoints.min",
    jCounterUp: "../../plugins/counterUp/jquery.counterup.min",
    leaflet: "../../plugins/map/leaflet/leaflet",
    catiline: "../../plugins/map/catiline/dist/catiline.min",
    shp: "../../plugins/map/shp/dist/shp.min",
    fileGdb: "../../plugins/map/filegdb/dist/fgdb.min",
    markerCluster: "../../plugins/map/markercluster/dist/leaflet.markercluster",
    zoomSlider: "../../plugins/map/zoomslider/L.Control.Zoomslider",
    spin: "../../plugins/map/spin/dist/spin.min",
    leafletSpin: "../../plugins/map/spin/leaflet.spin.min",
    colorbrewer: "../../plugins/map/colorbrewer",
    highcharts: "../../plugins/highcharts",
    PDFObject: "../../plugins/pdfobject/pdfobject.min",
    jQueryTagInput: "../../plugins/jquery-tag-input/jquery.tagsinput-revisited",
    fullcalendar: "../../plugins/fullcalendar/dist/index.global.min",
    "fullcalendar-moment":
      "../../plugins/fullcalendar/packages/momnet/index.global.min",
    rruleFc: "../../plugins/fullcalendar/packages/rrule/index.global",
    rrule: "https://cdn.jsdelivr.net/npm/rrule@2.6.4/dist/es5/rrule.min",
    luxon: "https://cdnjs.cloudflare.com/ajax/libs/luxon/3.4.3/luxon.min",
    "number-separator": "../../plugins/number-separator/easy-number-separator",
    steps: "../../plugins/jquery-steps/jquery.steps.min",
    multiselect: "../../plugins/multiselect/multiselect.min",
    bootstrap: "../../plugins/bootstrap.bundle.min",
    metismenu: "../../plugins/metismenu.min",
    scrollbar: "../../plugins/scrollbar",
    architect: "../../plugins/architect",
    blockui: "../../plugins/blockui.min"
  },
  waitSeconds: 0,
  urlArgs: "bust=" + new Date().getTime(),
  shim: {
    jQuery: {
      exports: "jQuery",
      init: function() {
        console.log("jQuery inited..");
      }
    },
    jQueryUI: {
      deps: ["jQuery"],
      exports: "jQueryUI",
      init: function() {
        console.log("jQueryUI inited..");
      }
    },
    nouislider: {
      deps: ["jQuery"],
      exports: "nouislider",
      init: function() {
        console.log("nouislider inited..");
      }
    },
    tablerMaster: {
      deps: ["jQuery", "nouislider"],
      exports: "tablerMaster",
      init: function() {
        console.log("tablerMaster inited..");
      }
    },
    tabler: {
      deps: ["jQuery", "tablerMaster"],
      exports: "tabler",
      init: function() {
        console.log("tabler inited..");
      }
    },
    jValidate: {
      deps: ["jQuery"],
      exports: "jValidate",
      init: function() {
        console.log("jValidate inited..");
      }
    },
    datatables: {
      deps: ["jQuery"],
      exports: "datatables",
      init: function() {
        console.log("datatables inited..");
      }
    },
    datatablesResponsive: {
      deps: ["jQuery", "datatables"],
      exports: "datatablesResponsive",
      init: function() {
        console.log("datatablesResponsive inited..");
      }
    },
    datatablesBootstrap: {
      deps: ["jQuery", "datatablesResponsive"],
      exports: "datatablesBootstrap4",
      init: function() {
        console.log("datatablesBootstrap4 inited..");
      }
    },
    select2: {
      deps: ["jQuery"],
      exports: "select2",
      init: function() {
        console.log("select2 inited..");
      }
    },
    flatPicker: {
      deps: ["jQuery"],
      exports: "flatPicker",
      init: function() {
        console.log("flatPicker inited..");
      }
    },
    flatPickerLocale: {
      deps: ["jQuery", "flatPicker"],
      exports: "flatPicker",
      init: function() {
        console.log("flatPickerLocale inited..");
      }
    },
    flatPickerMonthSelect: {
      deps: ["jQuery", "flatPicker"],
      exports: "flatPicker",
      init: function() {
        console.log("flatPickerMonthSelect inited..");
      }
    },
    bootstrapDatePicker: {
      deps: ["jQuery"],
      exports: "bootstrapDatePicker",
      init: function() {
        console.log("bootstrapDatePicker inited..");
      }
    },
    toastr: {
      deps: ["jQuery"],
      exports: "toastr",
      init: function() {
        console.log("toastr inited..");
      }
    },
    moment: {
      deps: ["jQuery"],
      exports: "moment",
      init: function() {
        console.log("moment inited..");
      }
    },
    tinymce: {
      deps: ["jQuery"],
      exports: "tinymce",
      init: function() {
        console.log("tinymce inited..");
      }
    },
    tinymceLocale: {
      deps: ["jQuery", "tinymce"],
      exports: "tinymceLocale",
      init: function() {
        console.log("tinymceLocale inited..");
      }
    },
    dropzone: {
      deps: ["jQuery"],
      exports: "dropzone",
      init: function() {
        console.log("dropzone inited..");
      }
    },
    waypoint: {
      deps: ["jQuery"],
      exports: "waypoint",
      init: function() {
        console.log("waypoint inited..");
      }
    },
    jCounterUp: {
      deps: ["jQuery", "waypoint"],
      exports: "jCounterUp",
      init: function() {
        console.log("jCounterUp inited..");
      }
    },
    leaflet: {
      deps: ["jQuery"],
      exports: "leaflet",
      init: function() {
        console.log("leaflet inited..");
      }
    },
    catiline: {
      deps: ["jQuery", "leaflet"],
      exports: "catiline",
      init: function() {
        console.log("leaflet catiline inited..");
      }
    },
    shp: {
      deps: ["jQuery", "leaflet"],
      exports: "shp",
      init: function() {
        console.log("leaflet shp inited..");
      }
    },
    fileGdb: {
      deps: ["jQuery", "leaflet"],
      exports: "fileGdb",
      init: function() {
        console.log("leaflet fileGdb inited..");
      }
    },
    markerCluster: {
      deps: ["jQuery", "leaflet"],
      exports: "markerCluster",
      init: function() {
        console.log("leaflet markerCluster inited..");
      }
    },
    zoomSlider: {
      deps: ["jQuery", "leaflet"],
      exports: "zoomSlider",
      init: function() {
        console.log("leaflet zoomSlider inited..");
      }
    },
    spin: {
      deps: ["jQuery"],
      exports: "spin",
      init: function() {
        console.log("spin inited..");
      }
    },
    leafletSpin: {
      deps: ["jQuery", "leaflet", "spin"],
      exports: "leafletSpin",
      init: function() {
        console.log("leaflet leafletSpin inited..");
      }
    },
    colorbrewer: {
      deps: ["jQuery"],
      exports: "colorbrewer",
      init: function() {
        console.log("colorbrewer inited..");
      }
    },
    PDFObject: {
      deps: ["jQuery"],
      exports: "PDFObject",
      init: function() {
        console.log("PDFObject inited..");
      }
    },
    jQueryTagInput: {
      deps: ["jQuery"],
      exports: "jQueryTagInput",
      init: function() {
        console.log("jQueryTagInput inited..");
      }
    },
    "number-separator": {
      deps: ["jQuery"],
      exports: "number-separator",
      init: function() {
        console.log("number-separator inited..");
      }
    },
    rrule: {
      deps: ["luxon"],
      exports: "rrule",
      init: function() {
        console.log("rrule inited..");
      }
    },
    luxon: {
      deps: ["fullcalendar"],
      exports: "luxon",
      init: function() {
        console.log("rrule inited..");
      }
    },
    fullcalendar: {
      deps: ["jQuery"],
      exports: "fullCalendar",
      init: function() {
        console.log("fullcalendar inited..");
      }
    },
    "fullcalendar-moment": {
      deps: ["fullcalendar"],
      exports: "fullCalendar-moment",
      init: function() {
        console.log("fullcalendar-moment inited..");
      }
    },
    rruleFc: {
      deps: ["fullcalendar", "rrule"],
      exports: "rruleFc",
      init: function() {
        console.log("rruleFc inited..");
      }
    },
    steps: {
      deps: ["jQuery"],
      exports: "steps",
      init: function() {
        console.log("steps inited..");
      }
    },
    multiselect: {
      deps: ["jQuery"],
      exports: "multiselect",
      init: function() {
        console.log("multiselect inited..");
      }
    },
    bootstrap: {
      exports: "bootstrap",
      init: function() {
        console.log("bootstrap inited..");
      }
    },
    metismenu: {
      exports: "metismenu",
      init: function() {
        console.log("metismenu inited..");
      }
    },
    scrollbar: {
      exports: "scrollbar",
      init: function() {
        console.log("scrollbar inited..");
      }
    },
    architect: {
      exports: "architect",
      deps: ["jQuery"],
      init: function() {
        console.log("architect inited..");
      }
    },
    blockui: {
      exports: "blockui",
      deps: ["jQuery"],
      init: function() {
        console.log("blockui inited..");
      }
    }
  },
  map: {
    "*": {
      jquery: "jQuery",
      "datatables.net": "datatables",
      FullCalendar: "fullcalendar"
    }
  },
  packages: [
    {
      name: "highcharts",
      main: "highcharts"
    }
  ]
});
