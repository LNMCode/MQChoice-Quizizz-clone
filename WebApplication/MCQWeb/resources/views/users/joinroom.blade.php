<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
</head>
<body>
    <br>
    <p>{{ $textBody }}</p>
    @if ($isCheckStart)
        <button type="button" class="btn btn-primary">Yes</button>
        <button type="button" class="btn btn-secondary">No and continous</button>
    @endif
</body>
<script src="https://cdn.socket.io/4.3.2/socket.io.min.js" integrity="sha384-KAZ4DtjNhLChOB/hxXuKqhMLYvx3b5MlT55xPEiNmREKRzeEm+RVPlTnAn0ajQNs" crossorigin="anonymous"></script>
<script src="../../js/users/joinroom.js"></script>
</html>