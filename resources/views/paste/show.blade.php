<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $paste->title }}</title>
</head>
<body>
<h1>{{ $paste->title }}</h1>
<p><small>Created: {{ $paste->created_at->diffForHumans() }}</small></p>

@if($paste->content)
    <pre>{{ $paste->content }}</pre>
@endif

@if($paste->file_path)
    <p>
        <strong>Attachment:</strong> {{ $paste->original_filename }}
        <a href="{{ route('paste.download', $paste->unique_id) }}">Download File</a>
    </p>
@endif

<p><a href="{{ route('home') }}">← Create Another Paste</a></p>
</body>
</html>
