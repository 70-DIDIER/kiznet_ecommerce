@extends('admin.layouts.app')

@section('content')
<div class="container py-4 mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Témoignages</h4>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">Créer un témoignage</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width:80px;">Image</th>
                        <th>Nom</th>
                        <th>Position</th>
                        <th>Étoiles</th>
                        <th style="width:300px;">Témoignage</th>
                        <th class="text-end" style="width:160px;">Actions</th>
                    </tr>
                </thead>
                <tbody id="testimonialsTableBody">
                    @forelse ($testimonials as $testimonial)
                        <tr>
                            <td>
                                @php
                                    $src = $testimonial->image ?: 'admin/assets/images/users/default-avatar.png';
                                    if (!filter_var($src, FILTER_VALIDATE_URL)) {
                                        $src = asset($src);
                                    }
                                @endphp
                                <img src="{{ $src }}" alt="{{ $testimonial->name }}" 
                                     style="height:48px;width:48px;object-fit:cover;border-radius:50%;">
                            </td>
                            <td class="fw-semibold">{{ $testimonial->name }}</td>
                            <td>{{ $testimonial->position ?? '—' }}</td>
                            <td>
                                <span class="text-warning">
                                    @for ($i = 0; $i < $testimonial->stars; $i++)
                                        ★
                                    @endfor
                                    @for ($i = $testimonial->stars; $i < 5; $i++)
                                        ☆
                                    @endfor
                                </span>
                                <small class="text-muted">({{ $testimonial->stars }}/5)</small>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ Str::limit($testimonial->text, 80) }}
                                </small>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.testimonials.edit', $testimonial) }}" 
                                   class="btn btn-sm btn-outline-secondary">Éditer</a>
                                <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" 
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Supprimer ce témoignage ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-4">Aucun témoignage trouvé.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($testimonials->hasPages())
            <div class="card-footer">
                {{ $testimonials->links() }}
            </div>
        @endif
    </div>
</div>
@endsection