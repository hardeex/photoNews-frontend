@include('feedback')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-4">Manage Editor Applications</h2>

    @foreach($editors as $editor)
        <div class="bg-white p-4 rounded shadow mb-4">
            <p><strong>Name:</strong> {{ $editor['full_name'] ?? $editor['name'] }}</p>
            <p><strong>Email:</strong> {{ $editor['email'] }}</p>
            <p><strong>Phone:</strong> {{ $editor['phone'] ?? 'N/A' }}</p>
            <p><strong>Experience:</strong> {{ $editor['editor_application']['experience'] ?? 'N/A' }}</p>
            <p><strong>Motivation:</strong> {{ $editor['editor_application']['motivation'] ?? 'N/A' }}</p>

            @if($editor['role'] === 'user')
                <!-- Approve Form -->
                <form action="{{ route('editor.approve', $editor['id']) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Approve</button>
                </form>

                <!-- Reject Form -->
                <form action="{{ route('editor.reject', $editor['id']) }}" method="POST" class="inline-block ml-2">
                    @csrf
                    <input type="text" name="reason" required placeholder="Rejection reason..." class="border rounded p-2">
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Reject</button>
                </form>
            @else
                <span class="text-green-700 font-semibold">Approved</span>
            @endif
        </div>
    @endforeach
</div>

