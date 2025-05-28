@extends('layouts.app')

@section('title', 'Tạo bài tập dạng form - LearnHub')

@section('styles')
<style>
    .question-card {
        position: relative;
        border-left: 5px solid #4e73df;
    }
    .question-card.active {
        border-left: 5px solid #1cc88a;
    }
    .question-actions {
        position: absolute;
        right: 15px;
        top: 15px;
    }
    .option-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    .option-item .form-check-input {
        margin-right: 10px;
    }
    .option-item .btn-remove-option {
        margin-left: 10px;
    }
    .drag-handle {
        cursor: move;
        color: #adb5bd;
    }
    .drag-handle:hover {
        color: #6c757d;
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white p-4 border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="fw-bold mb-0">Tạo bài tập dạng form</h2>
                        <div>
                            <a href="{{ route('teachers.assignments') }}" class="btn btn-outline-secondary me-2">
                                <i class="bi bi-arrow-left me-2"></i> Quay lại
                            </a>
                            <a href="{{ route('teachers.assignments.create') }}" class="btn btn-outline-primary">
                                <i class="bi bi-file-text me-2"></i> Tạo bài tập thông thường
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <form id="formAssignment" action="{{ route('teachers.assignments.store_form') }}" method="POST">
                @csrf
                
                <!-- Form Header -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold">Tiêu đề bài tập <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg" id="title" name="title" value="{{ old('title') }}" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="course_id" class="form-label fw-semibold">Khóa học <span class="text-danger">*</span></label>
                            <select class="form-select" id="course_id" name="course_id" required>
                                <option value="" selected disabled>Chọn khóa học</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">Mô tả bài tập <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="due_date" class="form-label fw-semibold">Thời hạn nộp bài <span class="text-danger">*</span></label>
                                    <input type="datetime-local" class="form-control" id="due_date" name="due_date" value="{{ old('due_date') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="max_score" class="form-label fw-semibold">Điểm tối đa <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="max_score" name="max_score" value="{{ old('max_score', 10) }}" min="0" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Questions Container -->
                <div id="questionsContainer">
                    <!-- Questions will be added here dynamically -->
                </div>
                
                <!-- Add Question Button -->
                <div class="mb-4">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="addQuestionDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-plus-circle me-2"></i> Thêm câu hỏi
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="addQuestionDropdown">
                            <li><a class="dropdown-item" href="#" onclick="addQuestion('multiple_choice')"><i class="bi bi-list-check me-2"></i> Trắc nghiệm (một đáp án)</a></li>
                            <li><a class="dropdown-item" href="#" onclick="addQuestion('checkbox')"><i class="bi bi-check-square me-2"></i> Trắc nghiệm (nhiều đáp án)</a></li>
                            <li><a class="dropdown-item" href="#" onclick="addQuestion('short_answer')"><i class="bi bi-input-cursor-text me-2"></i> Câu trả lời ngắn</a></li>
                            <li><a class="dropdown-item" href="#" onclick="addQuestion('paragraph')"><i class="bi bi-text-paragraph me-2"></i> Đoạn văn</a></li>
                            <li><a class="dropdown-item" href="#" onclick="addQuestion('file_upload')"><i class="bi bi-file-earmark-arrow-up me-2"></i> Tải lên tệp</a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="d-flex justify-content-between mb-5">
                    <a href="{{ route('teachers.assignments') }}" class="btn btn-secondary">Hủy</a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save me-2"></i> Lưu bài tập
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Question Templates (Hidden) -->
<div class="d-none">
    <!-- Multiple Choice Template -->
    <div id="template-multiple_choice" class="card border-0 shadow-sm mb-4 question-card">
        <div class="card-body p-4">
            <div class="question-actions">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary drag-handle">
                        <i class="bi bi-grip-vertical"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove-question">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
            
            <input type="hidden" name="questions[INDEX][type]" value="multiple_choice">
            
            <div class="mb-3">
                <div class="d-flex align-items-center">
                    <input type="text" class="form-control form-control-lg" name="questions[INDEX][title]" placeholder="Câu hỏi" required>
                    <div class="ms-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="questions[INDEX][required]" value="1" checked>
                            <label class="form-check-label">Bắt buộc</label>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Điểm</label>
                <input type="number" class="form-control" name="questions[INDEX][points]" value="1" min="0" step="0.5">
            </div>
            
            <div class="options-container mb-3">
                <div class="option-item">
                    <input type="radio" class="form-check-input" disabled>
                    <input type="text" class="form-control" name="questions[INDEX][options][]" placeholder="Tùy chọn 1" required>
                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove-option">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <div class="option-item">
                    <input type="radio" class="form-check-input" disabled>
                    <input type="text" class="form-control" name="questions[INDEX][options][]" placeholder="Tùy chọn 2" required>
                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove-option">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            </div>
            
            <button type="button" class="btn btn-sm btn-outline-secondary btn-add-option">
                <i class="bi bi-plus-circle me-2"></i> Thêm tùy chọn
            </button>
        </div>
    </div>
    
    <!-- Checkbox Template -->
    <div id="template-checkbox" class="card border-0 shadow-sm mb-4 question-card">
        <div class="card-body p-4">
            <div class="question-actions">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary drag-handle">
                        <i class="bi bi-grip-vertical"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove-question">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
            
            <input type="hidden" name="questions[INDEX][type]" value="checkbox">
            
            <div class="mb-3">
                <div class="d-flex align-items-center">
                    <input type="text" class="form-control form-control-lg" name="questions[INDEX][title]" placeholder="Câu hỏi" required>
                    <div class="ms-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="questions[INDEX][required]" value="1" checked>
                            <label class="form-check-label">Bắt buộc</label>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Điểm</label>
                <input type="number" class="form-control" name="questions[INDEX][points]" value="1" min="0" step="0.5">
            </div>
            
            <div class="options-container mb-3">
                <div class="option-item">
                    <input type="checkbox" class="form-check-input" disabled>
                    <input type="text" class="form-control" name="questions[INDEX][options][]" placeholder="Tùy chọn 1" required>
                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove-option">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <div class="option-item">
                    <input type="checkbox" class="form-check-input" disabled>
                    <input type="text" class="form-control" name="questions[INDEX][options][]" placeholder="Tùy chọn 2" required>
                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove-option">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            </div>
            
            <button type="button" class="btn btn-sm btn-outline-secondary btn-add-option">
                <i class="bi bi-plus-circle me-2"></i> Thêm tùy chọn
            </button>
        </div>
    </div>
    
    <!-- Short Answer Template -->
    <div id="template-short_answer" class="card border-0 shadow-sm mb-4 question-card">
        <div class="card-body p-4">
            <div class="question-actions">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary drag-handle">
                        <i class="bi bi-grip-vertical"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove-question">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
            
            <input type="hidden" name="questions[INDEX][type]" value="short_answer">
            
            <div class="mb-3">
                <div class="d-flex align-items-center">
                    <input type="text" class="form-control form-control-lg" name="questions[INDEX][title]" placeholder="Câu hỏi" required>
                    <div class="ms-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="questions[INDEX][required]" value="1" checked>
                            <label class="form-check-label">Bắt buộc</label>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Điểm</label>
                <input type="number" class="form-control" name="questions[INDEX][points]" value="1" min="0" step="0.5">
            </div>
            
            <div class="form-control bg-light" style="height: 38px;">
                <span class="text-muted">Câu trả lời ngắn</span>
            </div>
        </div>
    </div>
    
    <!-- Paragraph Template -->
    <div id="template-paragraph" class="card border-0 shadow-sm mb-4 question-card">
        <div class="card-body p-4">
            <div class="question-actions">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary drag-handle">
                        <i class="bi bi-grip-vertical"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove-question">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
            
            <input type="hidden" name="questions[INDEX][type]" value="paragraph">
            
            <div class="mb-3">
                <div class="d-flex align-items-center">
                    <input type="text" class="form-control form-control-lg" name="questions[INDEX][title]" placeholder="Câu hỏi" required>
                    <div class="ms-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="questions[INDEX][required]" value="1" checked>
                            <label class="form-check-label">Bắt buộc</label>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Điểm</label>
                <input type="number" class="form-control" name="questions[INDEX][points]" value="1" min="0" step="0.5">
            </div>
            
            <div class="form-control bg-light" style="height: 100px;">
                <span class="text-muted">Câu trả lời dài</span>
            </div>
        </div>
    </div>
    
    <!-- File Upload Template -->
    <div id="template-file_upload" class="card border-0 shadow-sm mb-4 question-card">
        <div class="card-body p-4">
            <div class="question-actions">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary drag-handle">
                        <i class="bi bi-grip-vertical"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove-question">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
            
            <input type="hidden" name="questions[INDEX][type]" value="file_upload">
            
            <div class="mb-3">
                <div class="d-flex align-items-center">
                    <input type="text" class="form-control form-control-lg" name="questions[INDEX][title]" placeholder="Câu hỏi" required>
                    <div class="ms-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="questions[INDEX][required]" value="1" checked>
                            <label class="form-check-label">Bắt buộc</label>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Điểm</label>
                <input type="number" class="form-control" name="questions[INDEX][points]" value="1" min="0" step="0.5">
            </div>
            
            <div class="form-control bg-light d-flex align-items-center justify-content-center" style="height: 100px;">
                <div class="text-center">
                    <i class="bi bi-cloud-arrow-up fs-3"></i>
                    <p class="mb-0 text-muted">Tải lên tệp</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    // Global counter for question indices
    let questionCounter = 0;
    
    // Add a new question
    function addQuestion(type) {
        const template = document.getElementById(`template-${type}`).cloneNode(true);
        template.id = `question-${questionCounter}`;
        template.classList.remove('d-none');
        
        // Replace INDEX placeholder with actual index
        const html = template.outerHTML.replace(/INDEX/g, questionCounter);
        
        // Add to container
        document.getElementById('questionsContainer').insertAdjacentHTML('beforeend', html);
        
        // Setup event listeners for the new question
        setupQuestionEvents(questionCounter);
        
        // Increment counter
        questionCounter++;
    }
    
    // Setup event listeners for question
    function setupQuestionEvents(index) {
        const questionId = `question-${index}`;
        const questionEl = document.getElementById(questionId);
        
        // Remove question
        questionEl.querySelector('.btn-remove-question').addEventListener('click', function() {
            questionEl.remove();
        });
        
        // Add option (for multiple choice and checkbox)
        const addOptionBtn = questionEl.querySelector('.btn-add-option');
        if (addOptionBtn) {
            addOptionBtn.addEventListener('click', function() {
                const optionsContainer = questionEl.querySelector('.options-container');
                const questionType = questionEl.querySelector('input[name$="[type]"]').value;
                const inputType = questionType === 'multiple_choice' ? 'radio' : 'checkbox';
                
                const optionItem = document.createElement('div');
                optionItem.className = 'option-item';
                optionItem.innerHTML = `
                    <input type="${inputType}" class="form-check-input" disabled>
                    <input type="text" class="form-control" name="questions[${index}][options][]" placeholder="Tùy chọn mới" required>
                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove-option">
                        <i class="bi bi-x-lg"></i>
                    </button>
                `;
                
                optionsContainer.appendChild(optionItem);
                
                // Setup remove option event
                setupRemoveOptionEvent(optionItem.querySelector('.btn-remove-option'));
            });
        }
        
        // Setup remove option events for existing options
        const removeOptionBtns = questionEl.querySelectorAll('.btn-remove-option');
        removeOptionBtns.forEach(btn => {
            setupRemoveOptionEvent(btn);
        });
        
        // Make question active when clicked
        questionEl.addEventListener('click', function() {
            document.querySelectorAll('.question-card').forEach(card => {
                card.classList.remove('active');
            });
            questionEl.classList.add('active');
        });
    }
    
    // Setup remove option event
    function setupRemoveOptionEvent(btn) {
        btn.addEventListener('click', function() {
            const optionsContainer = this.closest('.options-container');
            const optionItem = this.closest('.option-item');
            
            // Don't remove if it's the last option
            if (optionsContainer.querySelectorAll('.option-item').length > 1) {
                optionItem.remove();
            } else {
                alert('Phải có ít nhất một tùy chọn');
            }
        });
    }
    
    // Initialize sortable
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('questionsContainer');
        new Sortable(container, {
            animation: 150,
            handle: '.drag-handle',
            ghostClass: 'bg-light'
        });
        
        // Add initial question
        addQuestion('multiple_choice');
    });
    
    // Form validation before submit
    document.getElementById('formAssignment').addEventListener('submit', function(e) {
        const questions = document.querySelectorAll('.question-card');
        
        if (questions.length === 0) {
            e.preventDefault();
            alert('Vui lòng thêm ít nhất một câu hỏi');
        }
    });
</script>
@endsection 