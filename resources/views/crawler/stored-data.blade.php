<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stored Crawled Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Stored Crawled Data</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>URL</th>
            <th>Links</th>
            <th>Headings</th>
            <th>Paragraphs</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->url }}</td>
                <td>
                    <ul>
                        @foreach ($item->links as $link)
                            <li>{{ $link }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <ul>
                        @foreach ($item->headings as $heading)
                            <li>{{ $heading }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <ul>
                        @foreach ($item->paragraphs as $paragraph)
                            <li>{{ $paragraph }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>