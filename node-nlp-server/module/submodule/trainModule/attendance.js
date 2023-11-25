module.exports = function addAttendance(manager) {
    manager.addDocument("en", "give me the list of present today", "asking.employee.present.today")
    manager.addDocument("en", "activate the attendance system", "command.attendance");
    // Example 1
    manager.addDocument("en", "Hey, could you get the attendance system up and running?", "command.attendance");

    // Example 2
    manager.addDocument("en", "I'm looking to start the attendance system. Can you assist?", "command.attendance");

    // Example 3
    manager.addDocument("en", "Mind helping me activate attendance tracking?", "command.attendance");

    // Example 4
    manager.addDocument("en", "Let's initiate the attendance system. Sound good?", "command.attendance");

    // Example 5
    manager.addDocument("en", "Ready to switch on attendance monitoring. Can you do that?", "command.attendance");

    // Example 6
    manager.addDocument("en", "I need to get employee attendance going. Any help?", "command.attendance");

    // Example 7
    manager.addDocument("en", "Time to start the operation of the attendance system. Ready?", "command.attendance");

    // Example 8
    manager.addDocument("en", "Can you enable check-ins for the team, please?", "command.attendance");

    // Example 9
    manager.addDocument("en", "Let's kick off attendance tracking. What do you think?", "command.attendance");

    // Example 10
    manager.addDocument("en", "Ready to trigger the attendance system. Need anything else?", "command.attendance");

}