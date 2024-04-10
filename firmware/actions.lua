local http = require("http")
local SERVER_IP = "http://192.168.4.2:8000/api"
local DEVICE_ID = "1"

local actions = {}

function actions.sendDeviceStatus(deviceId)
    local URL = SERVER_IP .. "/devices/" .. deviceId
    local status = "online"
    local battery = 100
    local proximity = 100
    local connection = "wifi"
    local connection_strength = 100

    local payload = '{ "status": "'
        .. status
        .. '","battery": '
        .. battery
        .. ', "proximity": '
        .. proximity
        .. ', "connection": "'
        .. connection
        .. '", "connection_strength": '
        .. connection_strength
        .. "}"
    print(payload)

    print("Sending device status to " .. URL)
    http.put(URL, "Content-Type: application/json\r\n", payload, function(code, data)
        if code < 0 then
            print("HTTP request failed")
        else
            print(code, data)
        end
    end)
end

return actions
