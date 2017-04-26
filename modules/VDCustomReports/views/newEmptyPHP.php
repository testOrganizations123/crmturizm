<div class="sideBarContents"><div class="quickLinksDiv"><p onclick="window.location.href='index.php?module=VDCustomReports&view=List'" id="Contacts_sideBar_link_LBL_RECORDS_LIST" class="unSelectedQuickLink "><a class="quickLinks" href="index.php?module=VDCustomReports&view=List"><strong>Список отчетов</strong></a></p><p onclick="window.location.href='index.php?module=VDCustomReports&view=List&mode=getLeadsReport'" id="Contacts_sideBar_link_LBL_DASHBOARD" class="selectedQuickLink"><a class="quickLinks" href="index.php?module=VDCustomReports&view=List&mode=getLeadsReport"><strong>Заявки</strong></a></p><p onclick="window.location.href='index.php?module=VDCustomReports&view=List&mode=getBookingReport'" id="Contacts_sideBar_link_LBL_DASHBOARD" class="unSelectedQuickLink"><a class="quickLinks" href="index.php?module=VDCustomReports&view=List&mode=getBookingReport"><strong>Брони</strong></a></p></div></div></div></div><div class="contentsDiv span10 marginLeftZero" id="rightPanel" style="min-height:550px;"><div id="toggleButton" class="toggleButton" title="Показать/скрыть левую панель"><i id="tButtonImage" class="icon-chevron-left"></i></div><div class="VDDialogueDesigner_container" style="padding-left: 3%;padding-right: 3%"><br /><br /><h2>Аналитика</h2><hr /><div class="padding1per row-fluid" style="border:1px solid #ccc;"><div id="grafDay" style="width: 100%; height: 400px; background-color: #FFFFFF;"></div></div></div>
    <script>jQuery(document).ready(function(){AmCharts.makeChart("grafDay",
                {"type": "serial","categoryField": "category","autoMarginOffset": 40,"marginRight": 70,"marginTop": 70,"startDuration": 1,
            "fontSize": 13,
            "theme": "default",
            "categoryAxis": {"gridPosition": "start"},
            "trendLines": [],
            "guides": [],
            "valueAxes": [
						{
							"id": "ValueAxis-grafDay",
							"title": "Количество заявок"
						}
					],
                                        "allLabels": [],
                                        "balloon": {},
                                        "titles": [],
                                        "dataProvider": [
                                            {"category": "2016-10-01","Всего":88,"В работе":24,"Продажа":23,"Отказ":41,},
                                            {"category": "2016-10-02","Всего":23,"В работе":10,"Продажа":9,"Отказ":4,},
                                            {"category": "2016-10-03","Всего":167,"В работе":52,"Продажа":26,"Отказ":89,},
                                            {"category": "2016-10-04","Всего":154,"В работе":65,"Продажа":30,"Отказ":58,"Новая":1,},
                                            {"category": "2016-10-05","Всего":177,"В работе":98,"Продажа":8,"Отказ":71,},
                                            {"category": "2016-10-06","Всего":202,"В работе":101,"Продажа":3,"Отказ":98,},
                                            {"category": "2016-10-07","Всего":188,"В работе":104,"Продажа":1,"Отказ":81,"Новая":2,},
                                            {"category": "2016-10-08","Всего":136,"В работе":97,"Продажа":0,"Отказ":36,"Новая":3,},
                                            {"category": "2016-10-09","Всего":69,"В работе":57,"Продажа":1,"Отказ":10,"Новая":1,},
                                            {"category": "2016-10-10","Всего":269,"В работе":190,"Продажа":0,"Отказ":79,},
                                            {"category": "2016-10-11","Всего":436,"В работе":301,"Продажа":45,"Отказ":89,"Новая":1,},
                                            {"category": "2016-10-12","Всего":450,"В работе":303,"Продажа":58,"Отказ":88,"Новая":1,},
                                            {"category": "2016-10-13","Всего":692,"В работе":522,"Продажа":65,"Отказ":104,"Новая":1,},
                                        ],
                                        "graphs": [
                                            {"balloonText": "[[title]] [[category]] - [[value]] заявок",
                                                "fillAlphas": 0.9,"id": "grafDay-1",
                                                "title": "Всего",
                                                "type": "column",
                                                "valueField": "Всего"
                                            },
                                            {"balloonText": "[[title]] [[category]] - [[value]] заявок",
                                                "fillAlphas": 0.9,
                                                "id": "grafDay-2",
                                                "title": "В работе",
                                                "type": "column",
                                                "valueField": "В работе"
                                            },
                                            {"balloonText": "[[title]] [[category]] - [[value]] заявок",
                                                "fillAlphas": 0.9,
                                                "id": "grafDay-3",
                                                "title": "Продажа",
                                                "type": "column",
                                                "valueField": "Продажа"
                                            },
                                            {"balloonText": "[[title]] [[category]] - [[value]] заявок",
                                                "fillAlphas": 0.9,
                                                "id": "grafDay-4",
                                                "title": "Отказ",
                                                "type": "column",
                                                "valueField": "Отказ"
                                            },
                                        ],
                                        "colors": ["#ccc","#FCD202","#B0DE09","#ff2200",
                                        ],
                                    })});