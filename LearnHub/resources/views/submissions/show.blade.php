@extends('layouts.app')

@section('title', 'Chi tiết bài nộp - ' . $submission->assignment->title)

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white p-4 border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="fw-bold mb-0">Chi tiết bài nộp</h2>
                            <p class="text-muted mb-0 mt-1">
                                <a href="{{ route('assignments.show', $submission->assignment) }}" class="text-decoration-none">
                                    {{ $submission->assignment->title }}
                                </a> • 
                                <a href="{{ route('lessons.show', $submission->assignment->lesson) }}" class="text-decoration-none">
                                    {{ $submission->assignment->lesson->title }}
                                </a>
                            </p>
                        </div>
                        
                        @if(Auth::id() === $submission->assignment->course->teacher_id || Auth::user()->role === 'admin')
                            <a href="{{ route('assignments.submissions', $submission->assignment) }}" class="btn btn-outline-primary">
                                <i class="bi bi-arrow-left me-2"></i> Quay lại danh sách
                            </a>
                        @else
                            <a href="{{ route('assignments.show', $submission->assignment) }}" class="btn btn-outline-primary">
                                <i class="bi bi-arrow-left me-2"></i> Quay lại bài tập
                            </a>
                        @endif
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                @if($submission->student->avatar)
                                    <img src="{{ Storage::url($submission->student->avatar) }}" 
                                         alt="{{ $submission->student->name }}" 
                                         class="rounded-circle me-3" 
                                         style="width: 48px; height: 48px; object-fit: cover;">
                                @else
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" 
                                         style="width: 48px; height: 48px;">
                                        {{ substr($submission->student->name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <h5 class="fw-semibold mb-0">{{ $submission->student->name }}</h5>
                                    <p class="text-muted mb-0">{{ $submission->student->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <div class="mb-2">
                                <span class="text-muted">Thời gian nộp:</span>
                                <span class="fw-medium">{{ $submission->submitted_at->format('d/m/Y H:i') }}</span>
                                @if($submission->is_late)
                                    <span class="badge bg-warning text-dark ms-1">Nộp muộn</span>
                                @endif
                            </div>
                            <div>
                                <span class="text-muted">Trạng thái:</span>
                                @if($submission->status === 'submitted')
                                    <span class="badge bg-info">Đã nộp</span>
                                @elseif($submission->status === 'graded')
                                    <span class="badge bg-success">Đã chấm điểm</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    
                    @if($submission->assignment->is_form)
                        <!-- Hiển thị bài nộp dạng form -->
                        <div class="mb-4">
                            <h5 class="fw-bold mb-4">Câu trả lời</h5>
                            
                            @php
                                $content = json_decode($submission->content, true);
                                $answers = $content['answers'] ?? [];
                                $fileAnswers = $content['file_answers'] ?? [];
                            @endphp
                            
                            @foreach($submission->assignment->questions as $index => $question)
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            {{ $index + 1 }}. {{ $question['title'] ?? 'Câu hỏi không có tiêu đề' }}
                                            @if(isset($question['required']) && $question['required'])
                                                <span class="text-danger">*</span>
                                            @endif
                                        </h6>
                                        
                                        <div class="mt-3">
                                            <p class="fw-medium mb-1">Câu trả lời:</p>
                                            
                                            @switch($question['type'])
                                                @case('short_answer')
                                                @case('paragraph')
                                                    <div class="bg-light p-3 rounded">
                                                        {{ $answers[$index] ?? 'Không có câu trả lời' }}
                                                    </div>
                                                    @break
                                                    
                                                @case('multiple_choice')
                                                    <div class="bg-light p-3 rounded">
                                                        {{ $answers[$index] ?? 'Không có câu trả lời' }}
                                                    </div>
                                                    @break
                                                    
                                                @case('checkbox')
                                                    <div class="bg-light p-3 rounded">
                                                        @if(isset($answers[$index]) && is_array($answers[$index]))
                                                            <ul class="mb-0 ps-3">
                                                                @foreach($answers[$index] as $answer)
                                                                    <li>{{ $answer }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            Không có câu trả lời
                                                        @endif
                                                    </div>
                                                    @break
                                                    
                                                @case('file_upload')
                                                    @if(isset($fileAnswers[$index]))
                                                        <div class="bg-light p-3 rounded">
                                                            <div class="d-flex align-items-center">
                                                                <i class="bi bi-file-earmark me-2"></i>
                                                                <span>{{ $fileAnswers[$index]['filename'] }}</span>
                                                                <a href="{{ Storage::url($fileAnswers[$index]['path']) }}" 
                                                                   class="btn btn-sm btn-outline-primary ms-auto" download>
                                                                    <i class="bi bi-download"></i> Tải xuống
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="bg-light p-3 rounded">
                                                            Không có tệp đính kèm
                                                        </div>
                                                    @endif
                                                    @break
                                            @endswitch
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Hiển thị bài nộp thông thường -->
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3">Nội dung bài làm</h5>
                            <div class="bg-light p-4 rounded">
                                {!! nl2br(e($submission->content)) !!}
                            </div>
                        </div>
                        
                        @if($submission->file_path)
                            <div class="mb-4">
                                <h5 class="fw-bold mb-3">Tệp đính kèm</h5>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="bi bi-file-earmark me-2"></i>
                                                <span>{{ $submission->file_name }}</span>
                                            </div>
                                            <a href="{{ route('submissions.download', $submission) }}" class="btn btn-outline-primary">
                                                <i class="bi bi-download me-2"></i> Tải xuống
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                    
                    @if($submission->status === 'graded')
                        <div class="card bg-light border-0 mb-4">
                            <div class="card-body">
                                <h5 class="fw-bold mb-3">Đánh giá của giảng viên</h5>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center">
                                            <h2 class="fw-bold text-success mb-0">{{ $submission->score ?? $submission->grade }}</h2>
                                            <span class="text-muted ms-2">/ {{ $submission->assignment->max_score }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-md-end">
                                        <span class="text-muted">Chấm điểm lúc: {{ $submission->graded_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                </div>
                                
                                @if($submission->feedback)
                                    <div class="mt-3">
                                        <h6 class="fw-semibold">Nhận xét:</h6>
                                        <div class="p-3 bg-white rounded">
                                            {!! nl2br(e($submission->feedback)) !!}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @elseif(Auth::id() === $submission->assignment->course->teacher_id || Auth::user()->role === 'admin')
                        <div class="card border-primary mb-4">
                            <div class="card-body">
                                <h5 class="fw-bold mb-3">Chấm điểm bài nộp</h5>
                                <form action="{{ route('submissions.grade', $submission) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="score" class="form-label">Điểm số (tối đa {{ $submission->assignment->max_score }})</label>
                                        <input type="number" class="form-control" id="score" name="score" 
                                               min="0" max="{{ $submission->assignment->max_score }}" step="0.5" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="feedback" class="form-label">Nhận xét</label>
                                        <textarea class="form-control" id="feedback" name="feedback" rows="3"></textarea>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check2 me-2"></i> Lưu điểm
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 