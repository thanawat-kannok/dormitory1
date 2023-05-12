<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
include 'db.php';
include 'query.php';
if (!isset($_SESSION['premission']) == "Admin") {
    header("location: ../index.php");
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ระบบจัดการหอพัก</title>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->

    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Prompt:wght@300&display=swap" rel="stylesheet">

</head>
<style>

        p,
        body,
        td,
        input,
        select,
        button {
            font-family: -apple-system, system-ui, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            font-size: 14px;
        }

        body {
            padding: 0px;
            margin: 0px;
            background-color: #ffffff;
            font-family: 'Prompt', sans-serif;
        font-weight: bold;
        }

        a {
            color: #1155a3;
        }

        .space {
            margin: 10px 0px 10px 0px;
        }

        .header {
            background: #003267;
            background: linear-gradient(to right, #011329 0%, #00639e 44%, #011329 100%);
            padding: 20px 10px;
            color: white;
            box-shadow: 0px 0px 10px 5px rgba(0, 0, 0, 0.75);
        }

        .header a {
            color: white;
        }

        .header h1 a {
            text-decoration: none;
        }

        .header h1 {
            padding: 0px;
            margin: 0px;
        }

        .main {
            padding: 10px;
            margin-top: 10px;
        }

        select {
            padding: 5px;
        }

        .toolbar {
            margin: 10px 0px;
        }

        .toolbar button {
            padding: 5px 15px;
        }

        .icon {
            font-size: 14px;
            text-align: center;
            line-height: 14px;
            vertical-align: middle;

            cursor: pointer;
        }

        .toolbar-separator {
            width: 1px;
            height: 28px;
            /*content: '&nbsp;';*/
            display: inline-block;
            box-sizing: border-box;
            background-color: #ccc;
            margin-bottom: -8px;
            margin-left: 15px;
            margin-right: 15px;
        }

        .scheduler_default_rowheader_inner {
            border-right: 1px solid #ccc;
        }

        .scheduler_default_rowheadercol2 {
            background: White;
        }

        .scheduler_default_rowheadercol2 .scheduler_default_rowheader_inner {
            top: 2px;
            bottom: 2px;
            left: 2px;
            background-color: transparent;
            border-left: 5px solid #38761d;
            /* green */
            border-right: 0px none;
        }

        .status_dirty.scheduler_default_rowheadercol2 .scheduler_default_rowheader_inner {
            border-left: 5px solid #cc0000;
            /* red */
        }

        .status_cleanup.scheduler_default_rowheadercol2 .scheduler_default_rowheader_inner {
            border-left: 5px solid #e69138;
            /* orange */
        }

        .area-menu {
            background-image: url("data:image/svg+xml,%3Csvg width='10' height='10' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M 0.5 1.5 L 5 6.5 L 9.5 1.5' style='fill:none;stroke:%23999999;stroke-width:2;stroke-linejoin:round;stroke-linecap:butt' /%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: center center;
            border: 1px solid #ccc;
            background-color: #fff;
            border-radius: 3px;
            opacity: 0.8;
            cursor: pointer;
        }

        .area-menu:hover {
            opacity: 1;
        }
    </style>

<body>
    <div id="wrapper">
        <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php" style="width:300px"> <?php echo $hd['header']?></lable> </a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i><?php echo $_SESSION["fname_A"]; ?>&nbsp <lable><?php echo $_SESSION["lname_A"]; ?> <i class="fa fa-caret-down"></i>
                        <span class="badge" style="background-color:red"><?php echo $_SESSION["premission_A"]; ?></span>
					</a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="settings.php"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../logout.php" onclick="return confirm('ยืนยันการออกจากระบบ')"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <div style="background-color:#FF9900;color:black;font-size:20px" align="center">จัดการการจองห้องพัก</div>
                    </li>
                    <li>
                        <a href="home.php"><i class="fa fa-dashboard"></i> การจองห้อง <lable style="color:red">ใหม่ </lable><span class="badge"><?php echo $c; ?></span></a>
                    </li>
                    <li>
                        <a class="active-menu" href="messages.php"><i class="fa fa-desktop" ></i> ประวัติการจองห้องพัก</a>
                    </li>
                    <li>
                        <div style="background-color:#FF9900;color:black;font-size:20px" align="center">จัดการห้องพักและผู้ใช้งาน</div>
                    </li>
                    <li>
                        <a href="month.php"><i class="fa fa-calendar-check-o"></i> การจัดการห้องพัก</a>
                    </li>
                    <li>
                        <a href="user.php"><i class="fa fa-user-circle"></i> จัดการผู้ใช้</a>
                    </li>
                    <li>
                        <a href="receipt.php"><i class="fa fa-qrcode"></i> จัดการค่าเช่า รายเดือน </a>
                    </li>
                    <li>
                        <a href="price.php"><i class="fa fa-address-book"></i> ประวัติการชำระเงิน รายเดือน</a>
                    </li>
                    <li>
                        <div style="background-color:#FF9900;color:black;font-size:20px;" align="center">จัดการอื่นๆ</div>
                    </li>
                    <li>
                        <a href="profit.php"><i class="fa fa-line-chart"></i> รายรับ</a>
                    </li>
                    <li>
                        <a href="contect.php"><i class="fa fa-edit"></i> การจัดการเว็บไซน์</a>
                    </li>
                    <li>
                        <a href="log.php"><i class="fa fa-bug"></i> บันทึกประวัติ</a>
                    </li>




            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            รายงานการจอง<small> panel</small>
                        </h1>
                    </div>
                </div>
                <!-- /. ROW  -->
                <?php
                include('db.php');
                $mail = "SELECT * FROM `reserve`";
                $rew = mysqli_query($con, $mail);

                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="main">
                            <div style="width:220px; float:left;">
                                <div id="nav"></div>
                            </div>

                            <div style="margin-left: 220px;">

                                <div class="toolbar">

                                    Room filter:
                                    <select id="filter">
                                        <option value="0">All</option>
                                        <option value="1">Single</option>
                                        <option value="2">Double</option>
                                        <option value="4">Family</option>
                                    </select>

                                    &nbsp;&nbsp;

                                    <button id="addroom">Add Room</button>

                                    <div class="toolbar-separator"></div>

                                    Time range:
                                    <select id="timerange">
                                        <option value="week">Week</option>
                                        <option value="month" selected>Month</option>
                                    </select>
                                    <div class="toolbar-separator"></div>
                                    <label for="autocellwidth"><input type="checkbox" id="autocellwidth">Auto Cell Width</label>

                                </div>

                                <div id="dp"></div>

                            </div>

                        </div>

                        <script type="text/javascript">
                            const nav = new DayPilot.Navigator("nav");
                            nav.selectMode = "month";
                            nav.showMonths = 3;
                            nav.skipMonths = 3;
                            nav.onTimeRangeSelected = function(args) {
                                loadTimeline(args.start);
                                dp.update();
                                loadReservations();
                            };
                            nav.init();
                        </script>

                        <script>
                            const dp = new DayPilot.Scheduler("dp");

                            dp.allowEventOverlap = false;

                            dp.days = dp.startDate.daysInMonth();
                            loadTimeline(DayPilot.Date.today().firstDayOfMonth());

                            dp.eventDeleteHandling = "Update";

                            dp.timeHeaders = [{
                                    groupBy: "Month",
                                    format: "MMMM yyyy"
                                },
                                {
                                    groupBy: "Day",
                                    format: "d"
                                }
                            ];

                            dp.eventHeight = 80;
                            dp.cellWidth = 60;

                            dp.rowHeaderColumns = [{
                                    title: "ประเภท",
                                    display: "name",
                                    sort: "name"
                                },
                                {
                                    title: "ห้อง",
                                    display: "capacity",
                                    sort: "capacity"
                                },
                                {
                                    title: "เตียง",
                                    display: "status",
                                    sort: "status"
                                }
                            ];

                            dp.separators = [{
                                location: DayPilot.Date.now(),
                                color: "red"
                            }];

                            dp.contextMenuResource = new DayPilot.Menu({
                                items: [{
                                        text: "Edit...",
                                        onClick: async (args) => {
                                            const capacities = [{
                                                    name: "1",
                                                    id: 1
                                                },
                                                {
                                                    name: "2",
                                                    id: 2
                                                },
                                                {
                                                    name: "4",
                                                    id: 4
                                                },
                                            ];

                                            const statuses = [{
                                                    name: "Ready",
                                                    id: "Ready"
                                                },
                                                {
                                                    name: "Cleanup",
                                                    id: "Cleanup"
                                                },
                                                {
                                                    name: "Dirty",
                                                    id: "Dirty"
                                                },
                                            ];

                                            const form = [{
                                                    name: "Room Name",
                                                    id: "name"
                                                },
                                                {
                                                    name: "Capacity",
                                                    id: "capacity",
                                                    options: capacities
                                                },
                                                {
                                                    name: "Status",
                                                    id: "status",
                                                    options: statuses
                                                }
                                            ];

                                            const data = args.source.data;

                                            const modal = await DayPilot.Modal.form(form, data);
                                            if (modal.canceled) {
                                                return;
                                            }

                                            const room = modal.result;
                                            await DayPilot.Http.post("backend_room_update.php", room);
                                            dp.rows.update(room);
                                        }
                                    },
                                    {
                                        text: "Delete",
                                        onClick: async (args) => {
                                            const id = args.source.id;

                                            await DayPilot.Http.post("backend_room_delete.php", {
                                                id: id
                                            });
                                            dp.rows.remove(id);
                                        }
                                    }
                                ]
                            });

                            dp.onBeforeRowHeaderRender = (args) => {
                                const beds = (count) => {
                                    
                                };

                                args.row.columns[1].html = beds(args.row.data.capacity);
                                switch (args.row.data.status) {
                                    case "Dirty":
                                        args.row.cssClass = "status_dirty";
                                        break;
                                    case "Cleanup":
                                        args.row.cssClass = "status_cleanup";
                                        break;
                                }

                                args.row.columns[0].areas = [{
                                    right: 3,
                                    top: 3,
                                    width: 16,
                                    height: 16,
                                    cssClass: "area-menu",
                                    action: "ContextMenu",
                                    visibility: "Hover"
                                }];

                            };

                            // http://api.daypilot.org/daypilot-scheduler-oneventmoved/
                            dp.onEventMoved = async (args) => {
                                const params = {
                                    id: args.e.id(),
                                    newStart: args.newStart,
                                    newEnd: args.newEnd,
                                    newResource: args.newResource
                                };

                                const {
                                    data
                                } = await DayPilot.Http.post("backend_reservation_move.php", params);
                                dp.message(data.message);

                            };

                            // http://api.daypilot.org/daypilot-scheduler-oneventresized/
                            dp.onEventResized = async (args) => {
                                const params = {
                                    id: args.e.id(),
                                    newStart: args.newStart,
                                    newEnd: args.newEnd
                                };

                                const {
                                    data
                                } = await DayPilot.Http.post("backend_reservation_resize.php", params);
                                dp.message("Resized");

                            };

                            dp.onEventDeleted = async (args) => {
                                await DayPilot.Http.post("backend_reservation_delete.php", {
                                    id: args.e.id()
                                });
                                dp.message("Deleted.");
                            };

                            // event creating
                            // http://api.daypilot.org/daypilot-scheduler-ontimerangeselected/
                            dp.onTimeRangeSelected = async (args) => {

                                const rooms = dp.resources.map((item) => {
                                    return {
                                        name: item.name,
                                        id: item.id
                                    };
                                });

                                const form = [{
                                        name: "Text",
                                        id: "text"
                                    },
                                    {
                                        name: "Start",
                                        id: "start",
                                        dateFormat: "MM/dd/yyyy HH:mm tt"
                                    },
                                    {
                                        name: "End",
                                        id: "end",
                                        dateFormat: "MM/dd/yyyy HH:mm tt"
                                    },
                                    {
                                        name: "ประเภท",
                                        id: "resource",
                                        options: rooms
                                    },
                                ];

                                const data = {
                                    start: args.start,
                                    end: args.end,
                                    resource: args.resource
                                };

                                const modal = await DayPilot.Modal.form(form, data);

                                dp.clearSelection();
                                if (modal.canceled) {
                                    return;
                                }
                                const e = modal.result;

                                const {
                                    data: result
                                } = await DayPilot.Http.post("backend_reservation_create.php", e);

                                e.id = result.id;
                                e.paid = result.paid;
                                e.status = result.status;
                                dp.events.add(e);

                            };

                            dp.onEventClick = async (args) => {
                                const rooms = dp.resources.map((item) => {
                                    return {
                                        name: item.name,
                                        id: item.id
                                    };
                                });

                                const statuses = [{
                                        name: "New",
                                        id: "New"
                                    },
                                    {
                                        name: "Confirmed",
                                        id: "Confirmed"
                                    },
                                    {
                                        name: "Arrived",
                                        id: "Arrived"
                                    },
                                    {
                                        name: "CheckedOut",
                                        id: "CheckedOut"
                                    }
                                ];

                                const paidoptions = [{
                                        name: "0%",
                                        id: 0
                                    },
                                    {
                                        name: "50%",
                                        id: 50
                                    },
                                    {
                                        name: "100%",
                                        id: 100
                                    },
                                ]

                                const form = [{
                                        name: "Text",
                                        id: "text"
                                    },
                                    {
                                        name: "Start",
                                        id: "start",
                                        dateFormat: "MM/dd/yyyy h:mm tt"
                                    },
                                    {
                                        name: "End",
                                        id: "end",
                                        dateFormat: "MM/dd/yyyy h:mm tt"
                                    },
                                    {
                                        name: "Room",
                                        id: "resource",
                                        options: rooms
                                    },
                                    {
                                        name: "Status",
                                        id: "status",
                                        options: statuses
                                    },
                                    {
                                        name: "Paid",
                                        id: "paid",
                                        options: paidoptions
                                    },
                                ];

                                const data = args.e.data;

                                const modal = await DayPilot.Modal.form(form, data);

                                dp.clearSelection();
                                if (modal.canceled) {
                                    return;
                                }
                                const e = modal.result;
                                await DayPilot.Http.post("backend_reservation_update.php", e);
                                dp.events.update(e);
                            };

                            dp.onBeforeEventRender = (args) => {
                                const start = new DayPilot.Date(args.data.start);
                                const end = new DayPilot.Date(args.data.end);

                                const today = DayPilot.Date.today();
                                const now = new DayPilot.Date();

                                args.data.html = DayPilot.Util.escapeHtml(args.data.text) + " (" + start.toString("M/d/yyyy") + " - " + end.toString("M/d/yyyy") + ")";

                                switch (args.data.status) {
                                    case "New":
                                        const in2days = today.addDays(1);

                                        if (start < in2days) {
                                            args.data.barColor = '#cc0000';
                                            args.data.toolTip = 'Expired (not confirmed in time)';
                                        } else {
                                            args.data.barColor = '#e69138';
                                            args.data.toolTip = 'New';
                                        }
                                        break;
                                    case "Confirmed":
                                        const arrivalDeadline = today.addHours(18);

                                        if (start < today || (start.getDatePart() === today.getDatePart() && now > arrivalDeadline)) { // must arrive before 6 pm
                                            args.data.barColor = "#cc4125"; // red
                                            args.data.toolTip = 'Late arrival';
                                        } else {
                                            args.data.barColor = "#38761d";
                                            args.data.toolTip = "Confirmed";
                                        }
                                        break;
                                    case 'Arrived': // arrived
                                        const checkoutDeadline = today.addHours(10);

                                        if (end < today || (end.getDatePart() === today.getDatePart() && now > checkoutDeadline)) { // must checkout before 10 am
                                            args.data.barColor = "#cc4125"; // red
                                            args.data.toolTip = "Late checkout";
                                        } else {
                                            args.data.barColor = "#1691f4"; // blue
                                            args.data.toolTip = "Arrived";
                                        }
                                        break;
                                    case 'CheckedOut': // checked out
                                        args.data.barColor = "gray";
                                        args.data.toolTip = "Checked out";
                                        break;
                                    default:
                                        args.data.toolTip = "Unexpected state";
                                        break;
                                }

                                args.data.html = "<div>" + args.data.html + "<br /><span style='color:gray'>" + args.data.toolTip + "</span></div>";

                                const paid = args.data.paid;
                                const paidColor = "#aaaaaa";

                                args.data.areas = [{
                                        bottom: 10,
                                        right: 4,
                                        html: "<div style='color:" + paidColor + "; font-size: 8pt;'>Paid: " + paid + "%</div>",
                                        v: "Visible"
                                    },
                                    {
                                        left: 4,
                                        bottom: 8,
                                        right: 4,
                                        height: 2,
                                        html: "<div style='background-color:" + paidColor + "; height: 100%; width:" + paid + "%'></div>",
                                        v: "Visible"
                                    }
                                ];

                            };


                            dp.init();

                            const elements = {
                                filter: document.querySelector("#filter"),
                                timerange: document.querySelector("#timerange"),
                                autocellwidth: document.querySelector("#autocellwidth"),
                                addroom: document.querySelector("#addroom"),
                            };

                            loadRooms();
                            loadReservations();

                            function loadTimeline(date) {
                                dp.scale = "Manual";
                                dp.timeline = [];
                                const start = date.getDatePart().addHours(12);

                                for (let i = 0; i < dp.days; i++) {
                                    dp.timeline.push({
                                        start: start.addDays(i),
                                        end: start.addDays(i + 1)
                                    });
                                }
                            }

                            function loadReservations() {
                                dp.events.load("backend_reservations.php");
                            }

                            async function loadRooms() {
                                const {
                                    data
                                } = await DayPilot.Http.post("backend_rooms.php", {
                                    capacity: elements.filter.value
                                });
                                dp.resources = data;
                                dp.update();
                            }

                            elements.filter.addEventListener("change", (e) => {
                                loadRooms();
                            });

                            elements.timerange.addEventListener("change", () => {
                                switch (this.value) {
                                    case "week":
                                        dp.days = 7;
                                        nav.selectMode = "Week";
                                        nav.select(nav.selectionDay);
                                        break;
                                    case "month":
                                        dp.days = dp.startDate.daysInMonth();
                                        nav.selectMode = "Month";
                                        nav.select(nav.selectionDay);
                                        break;
                                }
                            });

                            elements.autocellwidth.addEventListener("click", () => {
                                dp.cellWidth = 60; // reset for "Fixed" mode
                                dp.cellWidthSpec = this.checked ? "Auto" : "Fixed";
                                dp.update();
                            });

                            elements.addroom.addEventListener("click", async (ev) => {
                                ev.preventDefault();

                                const capacities = [{
                                        name: "1",
                                        id: 1
                                    },
                                    {
                                        name: "2",
                                        id: 2
                                    },
                                    {
                                        name: "4",
                                        id: 4
                                    },
                                ];

                                const form = [{
                                        name: "Room Name",
                                        id: "name"
                                    },
                                    {
                                        name: "Capacity",
                                        id: "capacity",
                                        options: capacities
                                    }
                                ];

                                const data = {
                                    capacity: 2
                                };

                                const modal = await DayPilot.Modal.form(form, data);
                                if (modal.canceled) {
                                    return;
                                }

                                const room = modal.result;
                                const {
                                    data: result
                                } = await DayPilot.Http.post("backend_room_create.php", room);

                                room.id = result.id;
                                room.status = result.status;
                                dp.resources.push(room);
                                dp.update();

                            });
                        </script>
                    </div>
                </div>


            </div>

        </div>


    </div>
    <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTables-example').dataTable();
        });
    </script>
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>


</body>

</html>