[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)

<img src="/public/logo.svg" width="120"/>

# ClockIn Employee Attendance Tracker System

ClockIn is a Employee Attendance Tracker with its dedicated Fingerprint tracker component that operates using ESP8266 and Adafruit's fingerprint scanner.

## Tech Stack

**Client:** ElectronJS, Vite, Vue.js, TailwindCSS, HeadlessUI

**Server:** Laravel

**Database:** SQLite

**Firmware:** : `.ino` using Arduino Firmware,  ESP8266 (NodeMCU) for the Microcontroller, using .ino code, Adafruit fingerprint Sensor and SSD1306 OLED screens


## Demo
Insert gif or link to demo


## Screenshots
![App Screenshot](https://via.placeholder.com/468x300?text=App+Screenshot+Here)


## Acknowledgements
Credits to Praveen for Project Inspiration
 - [Awesome Readme Templates](https://awesomeopensource.com/project/elangosundar/awesome-README-templates)
 - [Awesome README](https://github.com/matiassingers/awesome-readme)

## Run Locally

Clone the project

```bash
  git clone https://link-to-project
```

Go to the project directory

```bash
  cd my-project
```

Install dependencies

```bash
  npm install
```

Start the server

```bash
  npm run start
```


## API Reference

#### Get all items

```http
POST http://192.168.253.251:8000/api/scan
Content-Type: application/json

{
    "fingerprint_id": 1
}
```


```http
GET http://192.168.253.251:8000/api/sync
```

```http
POST http://127.0.0.1:8000/api/fingerprints/enroll
Content-Type: application/json

{
    "device_id": 1,
    "employee_id": 1
}
```

```http
POST http://192.168.253.251:8000/api/fingerprints/delete
Content-Type: application/json

{
    "fingerprint_id":1
}
```

```http
DELETE http://192.168.253.251:8000/api/fingerprints/1
Content-Type: application/json
```

```http
POST http://192.168.253.251:8000/api/fingerprints
Content-Type: application/json

{
    "fingerprint_id":1
}
```

```http
DELETE http://192.168.253.251:8000/api/fingerprints/1
Content-Type: application/json
```

```http
PUT http://127.0.0.1:8000/api/devices/1
Content-Type: application/json

{
    "battery": 100,
    "proximity": 100,
    "connection": "wifi",
    "connection_strength": 100
}
```

```http
POST http://127.0.0.1:8000/api/employees
Content-Type: application/json

{
  "name": "John Doe",
  "email": "john.doe6@gmail.com",
  "password": "JohnDoe123",
  "phone_number": "+601123049307",
  "username": "johndoe",
  "image_url": "https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
  "role": "Software Engineer",
  "description": "I am a software engineer"
}
```

```http
GET /api/items
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `api_key` | `string` | **Required**. Your API key |

#### Get item

```http
  GET /api/items/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of item to fetch |

#### add(num1, num2)

Takes two numbers and returns the sum.


## Appendix

Any additional information goes here

- Blog Article
- Youtube Video
## Authors

- [@3urdparty](https://www.github.com/3urdparty)


## Contributing

Contributions are always welcome!

See `contributing.md` for ways to get started.

Please adhere to this project's `code of conduct`.


## Roadmap

- Additional browser support

- Add more integrations


## License

[MIT](https://choosealicense.com/licenses/mit/)


## Lessons Learned

What did you learn while building this project? What challenges did you face and how did you overcome them?


To setup:
1. Setup the docker container with Docker Compose
```bash
sudo docker-compose -p mqtt5 up -d
```

```bash
sudo docker exec -it CONTIANER_ID sh 
```
