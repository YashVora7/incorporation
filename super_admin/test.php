Codeshare logo
 ShareSign UpLog In
Reconnecting...
1
<!DOCTYPE html>
2
<html lang="en">
3
<head>
4
    <meta charset="UTF-8">
5
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
6
    <title>Document</title>
7
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
8
    <style>
9
        .form-group {
10
            border: 1px solid #ccc;
11
            margin-top: 5px;
12
            padding: 10px;
13
        }
14
        .accordion {
15
            cursor: pointer;
16
            padding: 10px;
17
            border: none;
18
            text-align: center;
19
            background-color: #f1f1f1;
20
            margin: 5px;
21
            display: inline-block;
22
            width: 100px;
23
        }
24
        .active {
25
            background-color: #ddd;
26
        }
27
        .panel {
28
            display: none;
29
            overflow: hidden;
30
            background-color: #f9f9f9;
31
            margin-top: 5px;
32
        }
33
        .button-container {
34
            display: flex; /* Align buttons in a horizontal line */
35
            margin-bottom: 10px;
36
        }
37
        #form-container {
38
            margin-top: 10px;
39
        }
40
        #result {
41
            margin-top: 20px;
42
        }
43
    </style>
44
</head>
45
<body>
46
<form id="main-form">
47
    <div class="button-container">
48
        <button type="button" id="add-btn">+</button>
49
        <button type="button" id="remove-btn">-</button>
50
        <button type="submit">Submit</button>
51
    </div>
52
    <div id="form-container">
53
        <button type="button" class="accordion" onclick="togglePanel(this)">Form 1</button>
54
        <div class="panel form-group">
55
            <input type="text" name="field1[]" placeholder="Field 1" required>
56
            <input type="text" name="field2[]" placeholder="Field 2" required>
57
        </div>
58
    </div>
59
</form>





px
Hide Ads
