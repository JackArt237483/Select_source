# Project Title

Simple PHP web app to fetch and display data from open APIs (news, weather) with pagination and source selection.

---

## Features

- Pure PHP backend without frameworks  
- Proxy API requests to hide API keys  
- Source selection via `source` GET parameter (e.g. `news`, `weather`)  
- Pagination support via `page` GET parameter  
- Clean MVC architecture (Router, Controller, View)  
- Responsive and modern UI with CSS  
- JSON responses for API calls  
- Secure handling of external API data

---

## Requirements

- PHP 7.4+  
- Web server (Apache, Nginx, or built-in PHP server)  
- Internet connection to access external APIs

---

## Installation & Usage

1. Clone or download the repo  
2. Place project folder into your web root or run built-in PHP server:  
   ```bash
   php -S localhost:8000
   ```  
3. Open in browser:  
   ```
   http://localhost:8000/
   ```  
4. To fetch data via API:  
   ```
   http://localhost:8000/?source=news&page=1
   ```  
   or  
   ```
   http://localhost:8000/?source=weather&page=1
   ```

---

## Project Structure

```
project/
├── config.php
├── public/
│   ├── index.php
│   └── style.css
├── src/
│   ├── Controllers/
│   │   └── MainController.php
│   ├── Services/
│   │   ├── DataSourceInterface.php
│   │   ├── NewsSource.php
│   │   └── WeatherSource.php
│   └── Router.php
├── views/
│   └── layout.php

## How It Works

- `Router` parses URL parameters and routes requests  
- If `source` and `page` are set, `MainController` fetches data from corresponding external API  
- Data returned as JSON  
- Otherwise loads main HTML layout for user interface  
- Frontend sends requests dynamically and displays paginated results  

---

## Notes & Recommendations

- Validate and sanitize incoming parameters to enhance security  
- Extend error handling for better UX  
- Add caching for improved performance on external API calls  
- Consider mobile responsiveness for wider device support  

---

## Author

**Jacker Artem** — Coder & Manager  
*Loves strong motivation and self-motivation*

---

