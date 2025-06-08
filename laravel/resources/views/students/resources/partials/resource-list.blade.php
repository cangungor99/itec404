@forelse ($resources as $resource)
<tr>
    <td>
        @php
            $ext = strtolower(pathinfo($resource->file_path, PATHINFO_EXTENSION));
            $icon = match($ext) {
                'pdf' => 'bi bi-file-earmark-pdf-fill text-danger',
                'doc', 'docx' => 'bi bi-file-earmark-word-fill text-primary',
                'jpg', 'jpeg', 'png', 'gif' => 'bi bi-file-earmark-image-fill text-warning',
                'mp4', 'avi', 'mov' => 'bi bi-camera-reels-fill text-info',
                'mp3', 'wav' => 'bi bi-music-note-beamed text-secondary',
                'zip', 'rar' => 'bi bi-file-earmark-zip-fill text-dark',
                default => 'bi bi-file-earmark-fill text-muted'
            };
        @endphp
        <i class="{{ $icon }} me-2"></i>
        <a href="{{ asset('storage/' . $resource->file_path) }}" target="_blank">
            {{ $resource->title }}
        </a>
    </td>
    <td>{{ $resource->description }}</td>
    <td>{{ $resource->user->name }}</td>
    <td>{{ number_format(Storage::disk('public')->size($resource->file_path)/1024, 2) }} KB</td>
    <td>{{ $resource->created_at->format('Y-m-d H:i') }}</td>
    <td>
        <a href="{{ asset('storage/' . $resource->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">View</a>
    </td>
</tr>
@empty
<tr>
    <td colspan="6" class="text-center">No resources found.</td>
</tr>
@endforelse
