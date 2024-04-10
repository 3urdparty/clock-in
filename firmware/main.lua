dofile("softap.lua")

local tmr = require("tmr")

local actions = require("actions")

tmr.create():alarm(10000, tmr.ALARM_AUTO, function()
    actions.sendDeviceStatus(1)
end)
