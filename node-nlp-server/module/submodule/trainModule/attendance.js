module.exports = function addAttendance(manager) {
    manager.addDocument("en", "give me the list of present today", "asking.employee.present.today")
    manager.addDocument("en", "activate the attendance system", "command.attendance");
}