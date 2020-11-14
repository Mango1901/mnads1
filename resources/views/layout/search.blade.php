<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>
<div class="row" style="padding-top: 20px">
<form action="" method="get">
    <div class="form-group" style="display: flex;!important;">
        <select id="selectdate" name="selectdate" class="form-control" style="width: 30%;border-radius: 5px">
            <option value="0">--{{trans('message.select')}}--</option>
            <option value="1">Hôm nay</option>
            <option value="2">Hôm qua</option>
            <option value="3">Tuần Này(từ thứ 2-Hôm nay)</option>
            <option value="4">7 ngày qua</option>
            <option value="5">Tuần trước(Th2-CN)</option>
            <option value="6">14 ngày qua</option>
            <option value="7">Tháng này</option>
            <option value="8">30 ngày qua</option>
            <option value="9">Tháng trước</option>
        </select>
        <input id="date1" style="margin-left: 20px;width: 25%" type="date" value="" class="form-control " name="date1">
        <span style="padding-top: 5px;padding-left: 10px">==></span>
        <input id="date2" style="margin-left: 20px;width: 25%" type="date" value="" class="form-control " name="date2">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit">
                <i class="fas fa-search fa-sm"></i>
            </button>


        </div>
        <a class="btn-primary">{!! Form::submit( 'PDF', ['class' => 'btn btn-default', 'name' => 'submitbutton', 'value' => 'save'])!!}</a>
    </div>

    <script src="{{asset('public/frontend/vendor/jquery/jquery.min.js')}}"></script>
    <script>

        function querySt(ji) {

            hu = window.location.search.substring(1);
            gy = hu.split("&");
            for (var i = 0; i < gy.length; i++) {
                ft = gy[i].split("=");
                if (ft[0] == ji) {
                    return ft[1];
                }
            }
        }


        $(document).ready(function () {
            $('#date1').val(querySt('date1'));
            $('#date2').val(querySt('date2'));
            // hu = window.location.search.substring(1);
            // gy = hu.split("&");
            // alert(gy);
            //
            // for (i = 0; i < gy.length; i++) {
            //     ft = gy[i].split("=");
            //     if (ft[0] == "selectdate") {
            //
            //     } else if (ft[0] == "date1") {
            //         $('#date1').val(ft[1]);
            //     } else {
            //         $('#date2').val(ft[1]);
            //     }
            // }

            $("#selectdate").change(function () {
                var str = "";
                $("select option:selected").each(function () {
                    str += $(this).val();
                    var today = new Date();
                    var yesterday = new Date();
                    if (today.getMonth() + 1 < 10) {
                        if (today.getDate() < 10) {
                            today = today.getFullYear() + "-0" + (today.getMonth() + 1) + "-0" + today.getDate();

                        } else {
                            today = today.getFullYear() + "-0" + (today.getMonth() + 1) + "-" + today.getDate();

                        }

                    } else {
                        if (today.getDate() < 10) {
                            today = today.getFullYear() + "-" + (today.getMonth() + 1) + "-0" + today.getDate();

                        } else {
                            today = today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate();

                        }
                    }


                    switch (str) {
                        case "1":
                            $("#date1").val(today);
                            $("#date2").val(today);
                            break;
                        case "2":
                            var date = new Date();
                            var last1day = new Date(date.getTime() - (1 * 24 * 60 * 60 * 1000));
                            if (last1day.getMonth() + 1 < 10) {
                                if (last1day.getDate() < 10) {
                                    last1day = last1day.getFullYear() + "-0" + (last1day.getMonth() + 1) + "-0" + last1day.getDate();
                                } else {
                                    last1day = last1day.getFullYear() + "-0" + (last1day.getMonth() + 1) + "-" + last1day.getDate();
                                }

                            } else {
                                if (last1day.getDate() < 10) {
                                    last1day = last1day.getFullYear() + "-" + (last1day.getMonth() + 1) + "-0" + last1day.getDate();
                                } else {
                                    last1day = last1day.getFullYear() + "-" + (last1day.getMonth() + 1) + "-" + last1day.getDate();
                                }
                            }
                            $("#date1").val(last1day);
                            $("#date2").val(last1day);
                            break;
                        case "3":

                        function getMonday(d) {
                            d = new Date(d);
                            var day = d.getDay(),
                                diff = d.getDate() - day + (day == 0 ? -6 : 1); // lấy ra thứ 2 đầu tuần
                            return new Date(d.setDate(diff));
                        }

                            var monday = getMonday(new Date());
                            if (monday.getMonth() + 1 < 10) {
                                if (monday.getDate() < 10) {
                                    monday = monday.getFullYear() + "-0" + (monday.getMonth() + 1) + "-0" + monday.getDate();
                                } else {
                                    monday = monday.getFullYear() + "-0" + (monday.getMonth() + 1) + "-" + monday.getDate();
                                }

                            } else {
                                if (monday.getDate() < 10) {
                                    monday = monday.getFullYear() + "-" + (monday.getMonth() + 1) + "-0" + monday.getDate();
                                } else {
                                    monday = monday.getFullYear() + "-" + (monday.getMonth() + 1) + "-" + monday.getDate();
                                }
                            }
                            $("#date1").val(monday);
                            $("#date2").val(today);
                            break;
                        case "4":
                            var date = new Date();
                            var last7day = new Date(date.getTime() - (7 * 24 * 60 * 60 * 1000));//lấy ra 7 ngày trước
                            if (last7day.getMonth() + 1 < 10) {
                                if (last7day.getDate() < 10) {
                                    last7day = last7day.getFullYear() + "-0" + (last7day.getMonth() + 1) + "-0" + last7day.getDate();
                                } else {
                                    last7day = last7day.getFullYear() + "-0" + (last7day.getMonth() + 1) + "-" + last7day.getDate();
                                }

                            } else {
                                if (last7day.getDate() < 10) {
                                    last7day = last7day.getFullYear() + "-" + (last7day.getMonth() + 1) + "-0" + last7day.getDate();
                                } else {
                                    last7day = last7day.getFullYear() + "-" + (last7day.getMonth() + 1) + "-" + last7day.getDate();
                                }
                            }
                            $("#date1").val(last7day);
                            $("#date2").val(today);
                            break;
                        case "5":

                        function getMonday(d) {
                            d = new Date(d);
                            var day = d.getDay(),
                                diff = d.getDate() - day + (day == 0 ? -6 : 1); // lấy ra thứ 2 đầu tuần
                            return new Date(d.setDate(diff));
                        }

                            var monday = getMonday(new Date());
                            var sunday = new Date();
                            if (monday.getMonth() + 1 < 10) {//lấy ra thứ 2 tuần trước
                                if (monday.getDate() - 7 < 10) {
                                    monday = monday.getFullYear() + "-0" + (monday.getMonth() + 1) + "-0" + (monday.getDate() - 7);
                                } else {
                                    monday = monday.getFullYear() + "-0" + (monday.getMonth() + 1) + "-" + (monday.getDate() - 7);
                                }

                            } else {
                                if (monday.getDate() - 7 < 10) {
                                    monday = monday.getFullYear() + "-" + (monday.getMonth() + 1) + "-0" + (monday.getDate() - 7);
                                } else {
                                    monday = monday.getFullYear() + "-" + (monday.getMonth() + 1) + "-" + (monday.getDate() - 7);
                                }
                            }
                            var monday2 = getMonday(new Date());
                            if (monday2.getMonth() + 1 < 10) {
                                if (monday2.getDate() - 1 < 10) {
                                    sunday = monday2.getFullYear() + "-0" + (monday2.getMonth() + 1) + "-0" + (monday2.getDate() - 1);
                                } else {
                                    sunday = monday2.getFullYear() + "-0" + (monday2.getMonth() + 1) + "-" + (monday2.getDate() - 1);
                                }

                            } else {
                                if (monday2.getDate() - 1 < 10) {
                                    sunday = monday2.getFullYear() + "-" + (monday2.getMonth() + 1) + "-0" + (monday2.getDate() - 1);
                                } else {
                                    sunday = monday2.getFullYear() + "-" + (monday2.getMonth() + 1) + "-" + (monday2.getDate() - 1);
                                }
                            }
                            $("#date1").val(monday);
                            $("#date2").val(sunday);
                            break;
                        case "6":
                            var date = new Date();
                            var last14day = new Date(date.getTime() - (14 * 24 * 60 * 60 * 1000));
                            if (last14day.getMonth() + 1 < 10) {
                                if ((last14day.getDate()) < 10) {
                                    last14day = last14day.getFullYear() + "-0" + (last14day.getMonth() + 1) + "-0" + (last14day.getDate());
                                } else {
                                    last14day = last14day.getFullYear() + "-0" + (last14day.getMonth() + 1) + "-" + (last14day.getDate() );
                                }

                            } else {
                                if ((last14day.getDate() - 14) < 10) {
                                    last14day = last14day.getFullYear() + "-" + (last14day.getMonth() + 1) + "-0" + (last14day.getDate());
                                } else {
                                    last14day = last14day.getFullYear() + "-" + (last14day.getMonth() + 1) + "-" + (last14day.getDate());
                                }
                            }
                            $("#date1").val(last14day);
                            $("#date2").val(today);
                            break;
                        case "7":
                            var thismounth = new Date();
                            var getday = thismounth.getDate();
                            thismounth.setDate(1);
                            if ((thismounth.getMonth() + 1)<10) {
                                if ((thismounth.getDate()) < 10) {
                                    thismounth = thismounth.getFullYear() + "-0" + (thismounth.getMonth() + 1) + "-0" + (thismounth.getDate());
                                } else {
                                    last14day = thismounth.getFullYear() + "-0" + (thismounth.getMonth() + 1) + "-" + (thismounth.getDate() );
                                }
                            } else {
                                if ((thismounth.getDate()) < 10) {
                                    thismounth = thismounth.getFullYear() + "-" + (thismounth.getMonth() + 1) + "-0" + (thismounth.getDate());
                                } else {
                                    last14day = thismounth.getFullYear() + "-" + (thismounth.getMonth() + 1) + "-" + (thismounth.getDate() );
                                }
                            }
                            $("#date1").val(thismounth);
                            $("#date2").val(today);
                            break;
                        case "8":
                            var date = new Date();
                            var last30day = new Date(date.getTime() - (30 * 24 * 60 * 60 * 1000));//lấy ra 30 ngày trước
                            if (last30day.getMonth() + 1 >= 10) {
                                if ((last30day.getDate()) < 10) {
                                    last30day = last30day.getFullYear() + "-" + (last30day.getMonth() + 1) + "-0" + (last30day.getDate());
                                } else {
                                    last30day = last30day.getFullYear() + "-" + (last30day.getMonth() + 1) + "-" + (last30day.getDate());
                                }

                            } else {
                                if ((last30day.getDate()) < 10) {
                                    last30day = last30day.getFullYear() + "-0" + (last30day.getMonth() + 1) + "-0" + (last30day.getDate());
                                } else {
                                    last30day = last30day.getFullYear() + "-0" + (last30day.getMonth() + 1) + "-" + (last30day.getDate());
                                }
                            }
                            $("#date1").val(last30day);
                            $("#date2").val(today);
                            break;
                        case "9":
                            var lastmonth = new Date();
                            lastmonth.setDate(1);
                            lastmonth.setMonth(lastmonth.getMonth()-1);
                            if ((lastmonth.getMonth() + 1)<10) {
                                if ((lastmonth.getDate()) < 10) {
                                    lastmonth = lastmonth.getFullYear() + "-0" + (lastmonth.getMonth() + 1) + "-0" + (lastmonth.getDate());
                                } else {
                                    lastmonth = lastmonth.getFullYear() + "-0" + (lastmonth.getMonth() + 1) + "-" + (lastmonth.getDate());
                                }
                            } else {
                                if ((lastmonth.getDate()) < 10) {
                                    lastmonth = lastmonth.getFullYear() + "-" + (lastmonth.getMonth() + 1) + "-0" + (lastmonth.getDate());
                                } else {
                                    lastmonth = lastmonth.getFullYear() + "-" + (lastmonth.getMonth() + 1) + "-" + (lastmonth.getDate());
                                }
                            }
                            $("#date1").val(lastmonth);

                            var lastmonth1 = new Date();
                            lastmonth1.setMonth(lastmonth1.getMonth() - 1);
                            lastmonth1.setDate(31);
                            if ((lastmonth1.getMonth() + 1)<10) {
                                if ((lastmonth1.getDate()) < 10) {
                                    lastmonth1 = lastmonth1.getFullYear() + "-0" + (lastmonth1.getMonth() + 1) + "-0" + (lastmonth1.getDate());
                                } else {
                                    lastmonth1 = lastmonth1.getFullYear() + "-0" + (lastmonth1.getMonth() + 1) + "-" + (lastmonth1.getDate());
                                }
                            } else {
                                if ((lastmonth1.getDate()) < 10) {
                                    lastmonth1 = lastmonth1.getFullYear() + "-" + (lastmonth1.getMonth() + 1) + "-0" + (lastmonth1.getDate());
                                } else {
                                    lastmonth1 = lastmonth1.getFullYear() + "-" + (lastmonth1.getMonth() + 1) + "-" + (lastmonth1.getDate());
                                }
                            }
                            $("#date2").val(lastmonth1);
                            break;
                    }
                });
            }).trigger("change");
        })
    </script>
</form>
<style type="text/css">
    .btn-primary{
        color: white;
        background-color: blue;
        border-radius:5px;
    }
</style>
</div>
