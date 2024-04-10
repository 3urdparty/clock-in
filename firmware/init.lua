local tmr = require("tmr")

tmr.create():alarm(3000, tmr.ALARM_SINGLE, function()
    local status, err = pcall(dofile, "main.lua")
    if not status then
        print("Error in main.lua:", err)
    end
end)
