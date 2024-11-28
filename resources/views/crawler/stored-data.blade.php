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
            <th>Images</th>
            <th>Videos</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->url }}</td>
                <td>
                    <ul>
                        @foreach (json_decode($item->links, true) as $link)
                            <li>{{ $link }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <ul>
                        @foreach (json_decode($item->headings, true) as $heading)
                            <li>{{ $heading }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <ul>
                        @foreach (json_decode($item->paragraphs, true) as $paragraph)
                            <li>{{ $paragraph }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <ul>
                        @foreach (json_decode($item->images, true) as $image)
                            <li><a href="{{ $image }}" target="_blank">{{ $image }}</a></li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <ul>
                        @foreach (json_decode($item->videos, true) as $video)
                            <li><a href="{{ $video }}" target="_blank">{{ $video }}</a></li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">No data found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
