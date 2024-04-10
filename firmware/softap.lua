local wifi = require("wifi")

-- Import the necessary modules
local wifi = require("wifi")

-- Disconnect any existing connections
wifi.sta.disconnect()
wifi.setmode(wifi.NULLMODE)
-- Set the SoftAP configuration
wifi.setmode(wifi.SOFTAP)
wifi.ap.config({
    ssid = "NodeMCU",
    pwd = "NodeMCU123+",
})

-- Print the IP address of the SoftAP
print("SoftAP IP address: " .. wifi.ap.getip())

wifi.eventmon.register(wifi.eventmon.AP_STACONNECTED, function(T)
    print("Connected from " .. T.MAC .. " with AID ID : " .. T.AID)
end)
