<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Crawler</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Web Crawler</h2>
    <form action="{{ route('crawler.crawl') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="url" class="form-label">Enter URL:</label>
            <input type="url" name="url" id="url" class="form-control" placeholder="https://example.com" required>
        </div>
        <button type="submit" class="btn btn-primary">Crawl</button>
    </form>
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            {{ $errors->first('error') }}
        </div>
    @endif
</div>
</body>
</html>
