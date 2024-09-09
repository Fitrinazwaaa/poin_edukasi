<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        * {
  border: 0;
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}
:root {
  font-size: 11px;
}

.search-bar {
  display: flex;
}
.search-bar input,
.search-btn, 
.search-btn:before, 
.search-btn:after {
  transition: all 0.25s ease-out;
}
.search-bar input,
.search-btn {
  width: 20px;
  height: 20px;
}
.search-bar input:invalid:not(:focus),
.search-btn {
  cursor: pointer;
}
.search-bar,
.search-bar input:focus,
.search-bar input:valid  {
  width: 100%;
}
.search-bar input:focus,
.search-bar input:not(:focus) + .search-btn:focus {
  outline: transparent;
}
.search-bar {
  margin: auto;
  padding: 24px;
  justify-content: center;
  max-width: 400px;
}
.search-bar input {
  background: transparent;
  border-radius: 24px;
  box-shadow: 0 0 0 6.4px #171717 inset;
  padding: 12px;
  transform: translate(8px,8px) scale(0.5);
  transform-origin: 100% 0;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
}
.search-bar input::-webkit-search-decoration {
  -webkit-appearance: none;
}
.search-bar input:focus,
.search-bar input:valid {
  background: #fff;
  border-radius: 6px 0 0 6px;
  box-shadow: 0 0 0 1.6px #d9d9d9 inset;
  transform: scale(1);
}
.search-btn {
  background: #171717;
  border-radius: 0 12px 12px 0 / 0 24px 24px 0;
  padding: 12px;
  position: relative;
  transform: translate(4px,4px) rotate(35deg) scale(0.25,0.125);
  transform-origin: 0 50%;
}
.search-btn:before, 
.search-btn:after {
  content: "";
  display: block;
  opacity: 0;
  position: absolute;
}
.search-btn:before {
  border-radius: 50%;
  box-shadow: 0 0 0 3.2px #f1f1f1 inset;
  top: 16%;
  left: 16%;
  width: 13px;
  height: 13px;
}
.search-btn:after {
  background: #f1f1f1;
  border-radius: 0 4px 4px 0;
  top: 45%;
  left: 40%;
  width: 9px;
  height: 3px;
  transform: translate(3.2px,0) rotate(45deg);
  transform-origin: 0 50%;
}
.search-btn span {
  display: inline-block;
  overflow: hidden;
  width: 1px;
  height: 1px;
}

/* Active state */
.search-bar input:focus + .search-btn,
.search-bar input:valid + .search-btn {
  background: #2762f3;
  border-radius: 0 6px 6px 0;
  transform: scale(1);
}
.search-bar input:focus + .search-btn:before, 
.search-bar input:focus + .search-btn:after,
.search-bar input:valid + .search-btn:before, 
.search-bar input:valid + .search-btn:after {
  opacity: 1;
}
.search-bar input:focus + .search-btn:hover,
.search-bar input:valid + .search-btn:hover,
.search-bar input:valid:not(:focus) + .search-btn:focus {
  background: #0c48db;
}
.search-bar input:focus + .search-btn:active,
.search-bar input:valid + .search-btn:active {
  transform: translateY(1px);
}

@media screen and (prefers-color-scheme: dark) {
  body, input {
    color: #f1f1f1;
  }
  body {
    background: #171717;
  }
  .search-bar input {
    box-shadow: 0 0 0 6.4px #f1f1f1 inset;
  }
  .search-bar input:focus,
  .search-bar input:valid {
    background: #3d3d3d;
    box-shadow: 0 0 0 1.6px #3d3d3d inset;
  }
  .search-btn {
    background: #f1f1f1;
  }
}
    </style>
</head>
<body>
    <form action="" class="search-bar">
        <input type="search" name="search" pattern=".*\S.*" required>
        <button class="search-btn" type="submit">
          <span>Search</span>
        </button>
    </form>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<?php