@extends('layouts.app')

@section('title', 'Bài tập dạng Google Form - LearnHub')

@section('styles')
<style>
    .question-card {
        border-left: 4px solid #4e73df;
        background-color: #fff;
        margin-bottom: 1.5rem;
    }
    .required-mark {
        color: #e74a3b;
    }
    .file-preview {
        max-width: 100%;
        max-height: 200px;
        display: block;
        margin-top: 10px;
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white p-4 border-0">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h2 class="fw-bold mb-0">{{ $assignment->title }}</h2>
                        <a href="{{ route('students.assignments') }}" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-left me-2"></i> Quay lại
                        </a>
                    </div>
                    <div class="d-flex align-items-center text-muted">
                        <span class="me-3">
                            <i class="bi bi-book me-1"></i> {{ $assignment->course->title }}
                        </span>
                        <span>
                            <i class="bi bi-calendar me-1"></i> Hạn nộp: 
                            {{ $assignment->due_date ? $assignment->due_date->format('d/m/Y H:i') : 'Không có hạn' }}
                        </span>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <div class="mb-4">
                        <div class="p-3 bg-light rounded">
                            <p>{{ $assignment->description }}</p>
                        </div>
                    </div>
                    
                    <!-- Hiển thị trạng thái nộp bài -->
                    @if($submission && $submission->submitted_at)
                        <div class="alert alert-success mb-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                                <div>
                                    <strong>Đã nộp bài</strong>
                                    <div>Thời gian nộp: {{ $submission->submitted_at->format('d/m/Y H:i') }}</div>
                                    @if($submission->is_late)
                                        <div class="text-danger">Đã nộp muộn</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning mb-4">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            Bạn chưa nộp bài tập này.
                            @if($assignment->due_date && $assignment->due_date->isFuture())
                                Hạn nộp còn {{ $assignment->due_date->diffForHumans() }}.
                            @elseif($assignment->due_date && $assignment->due_date->isPast())
                                <span class="text-danger">Đã quá hạn nộp.</span>
                            @endif
                        </div>
                    @endif
                    
                    <form id="formSubmission" action="{{ route('submissions.store', $assignment) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Danh sách câu hỏi -->
                        @foreach($assignment->questions as $index => $question)
                            <div class="card question-card mb-4 shadow-sm">
                                <div class="card-body p-4">
                                    <h5 class="card-title fw-bold mb-3">
                                        {{ $question['title'] }}
                                        @if(isset($question['required']) && $question['required'])
                                            <span class="required-mark">*</span>
                                        @endif
                                    </h5>
                                    
                                    <!-- Hiển thị câu trả lời đã nộp (nếu có) -->
                                    @php
                                        $existingAnswer = null;
                                        $disabled = false;
                                        
                                        if($submission && $submission->submitted_at) {
                                            $content = json_decode($submission->content, true);
                                            $existingAnswer = $content['answers'][$index] ?? null;
                                            $disabled = true;
                                        }
                                    @endphp
                                    
                                    <!-- Hiển thị các loại câu hỏi khác nhau -->
                                    @if($question['type'] == 'multiple_choice')
                                        <!-- Câu hỏi trắc nghiệm (một đáp án) -->
                                        @foreach($question['options'] as $optionIndex => $option)
                                            <div class="form-check mb-2">
                                                <input type="radio" 
                                                    class="form-check-input" 
                                                    id="q{{ $index }}_option{{ $optionIndex }}" 
                                                    name="answers[{{ $index }}]" 
                                                    value="{{ $option }}"
                                                    {{ $existingAnswer == $option ? 'checked' : '' }}
                                                    {{ $disabled ? 'disabled' : '' }}
                                                    {{ isset($question['required']) && $question['required'] ? 'required' : '' }}>
                                                <label class="form-check-label" for="q{{ $index }}_option{{ $optionIndex }}">
                                                    {{ $option }}
                                                </label>
                                            </div>
                                        @endforeach
                                    
                                    @elseif($question['type'] == 'checkbox')
                                        <!-- Câu hỏi trắc nghiệm (nhiều đáp án) -->
                                        @foreach($question['options'] as $optionIndex => $option)
                                            <div class="form-check mb-2">
                                                <input type="checkbox" 
                                                    class="form-check-input" 
                                                    id="q{{ $index }}_option{{ $optionIndex }}" 
                                                    name="answers[{{ $index }}][]" 
                                                    value="{{ $option }}"
                                                    {{ $existingAnswer && in_array($option, $existingAnswer) ? 'checked' : '' }}
                                                    {{ $disabled ? 'disabled' : '' }}>
                                                <label class="form-check-label" for="q{{ $index }}_option{{ $optionIndex }}">
                                                    {{ $option }}
                                                </label>
                                            </div>
                                        @endforeach
                                        
                                    @elseif($question['type'] == 'short_answer')
                                        <!-- Câu trả lời ngắn -->
                                        <input type="text" 
                                            class="form-control" 
                                            name="answers[{{ $index }}]" 
                                            placeholder="Câu trả lời của bạn"
                                            value="{{ $existingAnswer ?? '' }}"
                                            {{ $disabled ? 'disabled' : '' }}
                                            {{ isset($question['required']) && $question['required'] ? 'required' : '' }}>
                                            
                                    @elseif($question['type'] == 'paragraph')
                                        <!-- Đoạn văn -->
                                        <textarea 
                                            class="form-control" 
                                            name="answers[{{ $index }}]" 
                                            rows="4" 
                                            placeholder="Câu trả lời của bạn"
                                            {{ $disabled ? 'disabled' : '' }}
                                            {{ isset($question['required']) && $question['required'] ? 'required' : '' }}>{{ $existingAnswer ?? '' }}</textarea>
                                            
                                    @elseif($question['type'] == 'file_upload')
                                        <!-- Tải lên tệp -->
                                        @if(!$disabled)
                                            <input type="file" 
                                                class="form-control" 
                                                name="file_answers[{{ $index }}]"
                                                {{ isset($question['required']) && $question['required'] ? 'required' : '' }}>
                                        @endif
                                        
                                        @if($existingAnswer)
                                            <div class="mt-2">
                                                <p>Đã nộp: {{ $existingAnswer['filename'] }}</p>
                                                <a href="{{ Storage::url($existingAnswer['path']) }}" 
                                                   class="btn btn-sm btn-outline-primary" 
                                                   target="_blank">
                                                    <i class="bi bi-eye me-1"></i> Xem tệp
                                                </a>
                                            </div>
                                        @endif
                                    @endif
                                    
                                    <!-- Hiển thị điểm số cho câu hỏi -->
                                    <div class="mt-2 text-muted small">
                                        <i class="bi bi-star me-1"></i> {{ $question['points'] ?? 1 }} điểm
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                        <!-- Nút submit -->
                        @if(!$submission || !$submission->submitted_at)
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('students.assignments') }}" class="btn btn-secondary">Quay lại</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-send me-2"></i> Nộp bài
                                </button>
                            </div>
                        @else
                            <div class="text-center">
                                <a href="{{ route('students.assignments') }}" class="btn btn-primary">
                                    <i class="bi bi-arrow-left me-2"></i> Quay lại danh sách bài tập
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Preview file uploads
    document.addEventListener('DOMContentLoaded', function() {
        const fileInputs = document.querySelectorAll('input[type="file"]');
        
        fileInputs.forEach(input => {
            input.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    // Remove existing preview
                    const parent = this.parentElement;
                    const existingPreview = parent.querySelector('.file-preview');
                    if (existingPreview) {
                        existingPreview.remove();
                    }
                    
                    // Check if it's an image
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'file-preview mt-2 rounded';
                            parent.appendChild(img);
                        }
                        reader.readAsDataURL(file);
                    } else {
                        // Show file name for non-images
                        const fileInfo = document.createElement('div');
                        fileInfo.className = 'alert alert-info mt-2';
                        fileInfo.innerHTML = `<i class="bi bi-file-earmark me-2"></i> ${file.name}`;
                        parent.appendChild(fileInfo);
                    }
                }
            });
        });
    });
</script>
@endsection 