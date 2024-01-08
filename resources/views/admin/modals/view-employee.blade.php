<!-- Modal -->
<div class="modal fade" id="employeeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><span id="name"></span> - <span
                        class="text-danger">Attendance
                        Records</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                {{-- <div class="container row">
                    <table id="state-saving-datatable" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr class="text-center">
                                <th>Date</th>
                                <th>Time-In</th>
                                <th>Time-Out</th>  
                                <th>Captured</th>
                            </tr>
                        </thead>
                        <tbody class="text-center tbody">
                            
                            
                        </tbody>
                    </table>
                </div> --}}


                <div class="container cal">
                    <div class="left">
                        <div class="calendar">
                            <div class="month">
                                <i class="fas fa-angle-left prev"></i>
                                <div class="date">december 2015</div>
                                <i class="fas fa-angle-right next"></i>
                            </div>
                            <div class="weekdays">
                                <div>Sun</div>
                                <div>Mon</div>
                                <div>Tue</div>
                                <div>Wed</div>
                                <div>Thu</div>
                                <div>Fri</div>
                                <div>Sat</div>
                            </div>
                            <div class="days"></div>
                            <div class="goto-today">
                                <div class="goto">
                                    <input type="text" placeholder="mm/yyyy" class="date-input" />
                                    <button class="goto-btn">Go</button>
                                </div>
                                <button class="today-btn">Today</button>
                            </div>
                        </div>
                    </div>
                    <div class="right">
                        <div class="today-date">
                            <div class="event-day">wed</div>
                            <div class="event-date">12th december 2022</div>
                        </div>
                        <div class="events"></div>
                        <div class="add-event-wrapper">
                            <div class="add-event-header">
                                <div class="title">Add Event</div>
                                <i class="fas fa-times close"></i>
                            </div>
                            <div class="add-event-body">
                                <div class="add-event-input">
                                    <input type="text" placeholder="Event Name" class="event-name" />
                                </div>
                                <div class="add-event-input">
                                    <input type="text" placeholder="Event Time From" class="event-time-from" />
                                </div>
                                <div class="add-event-input">
                                    <input type="text" placeholder="Event Time To" class="event-time-to" />
                                </div>
                            </div>
                            <div class="add-event-footer">
                                <button class="add-event-btn">Add Event</button>
                            </div>
                        </div>
                    </div>
                    <button class="add-event">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>

                {{-- <div class="credits">
                    <p>
                        Watch Tutorial on Youtube
                        <a href="https://youtu.be/6EVgmpm4z5U" target="_blank">Open Source Coding</a>
                    </p>
                </div> --}}

            </div>

        </div>
    </div>
</div>
