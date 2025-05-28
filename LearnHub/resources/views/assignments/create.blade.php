@extends('layouts.app')

@section('title', 'Tạo bài tập mới')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white p-4 border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="fw-bold mb-0">Tạo bài tập mới</h2>
                        <a href="{{ route('lessons.show', $lesson) }}" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-left me-2"></i> Quay lại bài học
                        </a>
                    </div>
                    <p class="text-muted mt-2 mb-0">Bài học: {{ $lesson->title }}</p>
                </div>
                
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <ul class="nav nav-tabs mb-4" id="assignmentTypeTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="regular-tab" data-bs-toggle="tab" 
                                    data-bs-target="#regular-tab-pane" type="button" role="tab" 
                                    aria-controls="regular-tab-pane" aria-selected="true">
                                Bài tập thông thường
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="form-tab" data-bs-toggle="tab" 
                                    data-bs-target="#form-tab-pane" type="button" role="tab" 
                                    aria-controls="form-tab-pane" aria-selected="false">
                                Bài tập dạng form
                            </button>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="assignmentTypeTabContent">
                        <!-- Bài tập thông thường -->
                        <div class="tab-pane fade show active" id="regular-tab-pane" role="tabpanel" 
                             aria-labelledby="regular-tab" tabindex="0">
                            <form action="{{ route('assignments.store', $lesson) }}" method="POST">
                                @csrf
                                <input type="hidden" name="is_form" value="0">
                                
                                <div class="mb-4">
                                    <label for="title" class="form-label fw-semibold">Tiêu đề bài tập <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="description" class="form-label fw-semibold">Mô tả bài tập</label>
                                    <textarea class="form-control" id="description" name="description" rows="5">{{ old('description') }}</textarea>
                                    <div class="form-text">Mô tả chi tiết về bài tập, yêu cầu, hướng dẫn, v.v.</div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="due_date" class="form-label fw-semibold">Hạn nộp bài</label>
                                    <input type="datetime-local" class="form-control" id="due_date" name="due_date" value="{{ old('due_date') }}">
                                </div>
                                
                                <div class="mb-4">
                                    <label for="max_score" class="form-label fw-semibold">Điểm tối đa</label>
                                    <input type="number" class="form-control" id="max_score" name="max_score" value="{{ old('max_score', 10) }}" min="1" max="100">
                                </div>
                                
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-2"></i> Tạo bài tập
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Bài tập dạng form -->
                        <div class="tab-pane fade" id="form-tab-pane" role="tabpanel" 
                             aria-labelledby="form-tab" tabindex="0">
                            <form action="{{ route('assignments.store', $lesson) }}" method="POST" id="formAssignmentForm">
                                @csrf
                                <input type="hidden" name="is_form" value="1">
                                
                                <div class="mb-4">
                                    <label for="form_title" class="form-label fw-semibold">Tiêu đề bài tập <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="form_title" name="title" value="{{ old('title') }}" required>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="form_description" class="form-label fw-semibold">Mô tả bài tập</label>
                                    <textarea class="form-control" id="form_description" name="description" rows="5">{{ old('description') }}</textarea>
                                    <div class="form-text">Mô tả chi tiết về bài tập, yêu cầu, hướng dẫn, v.v.</div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="form_due_date" class="form-label fw-semibold">Hạn nộp bài</label>
                                    <input type="datetime-local" class="form-control" id="form_due_date" name="due_date" value="{{ old('due_date') }}">
                                </div>
                                
                                <div class="mb-4">
                                    <label for="form_max_score" class="form-label fw-semibold">Điểm tối đa</label>
                                    <input type="number" class="form-control" id="form_max_score" name="max_score" value="{{ old('max_score', 10) }}" min="1" max="100">
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Câu hỏi</label>
                                    <div class="form-text mb-3">Tạo các câu hỏi cho bài tập dạng form.</div>
                                    
                                    <div id="questions-container">
                                        <!-- Các câu hỏi sẽ được thêm vào đây -->
                                    </div>
                                    
                                    <button type="button" class="btn btn-outline-primary mt-3" id="add-question">
                                        <i class="bi bi-plus-circle me-2"></i> Thêm câu hỏi
                                    </button>
                                </div>
                                
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-2"></i> Tạo bài tập
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Template cho các loại câu hỏi -->
<template id="question-template">
    <div class="question-item card mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title mb-0">Câu hỏi <span class="question-number"></span></h5>
                <button type="button" class="btn btn-sm btn-outline-danger remove-question">
                    <i class="bi bi-trash"></i> Xóa
                </button>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Nội dung câu hỏi <span class="text-danger">*</span></label>
                <input type="text" class="form-control question-text" name="questions[0][text]" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Loại câu hỏi</label>
                <select class="form-select question-type" name="questions[0][type]">
                    <option value="short_answer">Câu trả lời ngắn</option>
                    <option value="paragraph">Đoạn văn</option>
                    <option value="multiple_choice">Trắc nghiệm (một lựa chọn)</option>
                    <option value="checkbox">Trắc nghiệm (nhiều lựa chọn)</option>
                    <option value="file_upload">Tải lên tệp</option>
                </select>
            </div>
            
            <div class="options-container d-none">
                <label class="form-label">Các lựa chọn</label>
                <div class="options-list">
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="questions[0][options][]" placeholder="Lựa chọn">
                        <button type="button" class="btn btn-outline-danger remove-option">
                            <i class="bi bi-dash"></i>
                        </button>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-outline-secondary add-option mt-2">
                    <i class="bi bi-plus"></i> Thêm lựa chọn
                </button>
            </div>
            
            <div class="form-check mt-3">
                <input class="form-check-input" type="checkbox" name="questions[0][required]" id="question-required-0">
                <label class="form-check-label" for="question-required-0">
                    Bắt buộc trả lời
                </label>
            </div>
        </div>
    </div>
</template>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let questionCount = 0;
        const questionsContainer = document.getElementById('questions-container');
        const questionTemplate = document.getElementById('question-template');
        const addQuestionBtn = document.getElementById('add-question');
        
        // Thêm câu hỏi mới
        addQuestionBtn.addEventListener('click', function() {
            addQuestion();
        });
        
        // Thêm câu hỏi đầu tiên
        addQuestion();
        
        // Hàm thêm câu hỏi
        function addQuestion() {
            const questionItem = questionTemplate.content.cloneNode(true);
            const questionNumber = ++questionCount;
            
            // Cập nhật số thứ tự và name
            questionItem.querySelector('.question-number').textContent = questionNumber;
            questionItem.querySelector('.question-text').name = `questions[${questionNumber}][text]`;
            questionItem.querySelector('.question-type').name = `questions[${questionNumber}][type]`;
            questionItem.querySelector('.form-check-input').name = `questions[${questionNumber}][required]`;
            questionItem.querySelector('.form-check-input').id = `question-required-${questionNumber}`;
            questionItem.querySelector('.form-check-label').setAttribute('for', `question-required-${questionNumber}`);
            
            // Xử lý sự kiện xóa câu hỏi
            questionItem.querySelector('.remove-question').addEventListener('click', function() {
                this.closest('.question-item').remove();
                updateQuestionNumbers();
            });
            
            // Xử lý sự kiện thay đổi loại câu hỏi
            questionItem.querySelector('.question-type').addEventListener('change', function() {
                const optionsContainer = this.closest('.question-item').querySelector('.options-container');
                
                if (this.value === 'multiple_choice' || this.value === 'checkbox') {
                    optionsContainer.classList.remove('d-none');
                    
                    // Thêm ít nhất 2 lựa chọn nếu chưa có
                    const optionsList = optionsContainer.querySelector('.options-list');
                    if (optionsList.children.length < 2) {
                        addOption(optionsList, questionNumber);
                        addOption(optionsList, questionNumber);
                    }
                } else {
                    optionsContainer.classList.add('d-none');
                }
            });
            
            // Xử lý sự kiện thêm lựa chọn
            questionItem.querySelector('.add-option').addEventListener('click', function() {
                const optionsList = this.closest('.options-container').querySelector('.options-list');
                addOption(optionsList, questionNumber);
            });
            
            questionsContainer.appendChild(questionItem);
        }
        
        // Hàm thêm lựa chọn
        function addOption(optionsList, questionNumber) {
            const optionItem = document.createElement('div');
            optionItem.className = 'input-group mb-2';
            optionItem.innerHTML = `
                <input type="text" class="form-control" name="questions[${questionNumber}][options][]" placeholder="Lựa chọn">
                <button type="button" class="btn btn-outline-danger remove-option">
                    <i class="bi bi-dash"></i>
                </button>
            `;
            
            optionItem.querySelector('.remove-option').addEventListener('click', function() {
                this.closest('.input-group').remove();
            });
            
            optionsList.appendChild(optionItem);
        }
        
        // Cập nhật số thứ tự câu hỏi
        function updateQuestionNumbers() {
            const questionItems = document.querySelectorAll('.question-item');
            questionItems.forEach((item, index) => {
                const questionNumber = index + 1;
                item.querySelector('.question-number').textContent = questionNumber;
                item.querySelector('.question-text').name = `questions[${questionNumber}][text]`;
                item.querySelector('.question-type').name = `questions[${questionNumber}][type]`;
                item.querySelector('.form-check-input').name = `questions[${questionNumber}][required]`;
                item.querySelector('.form-check-input').id = `question-required-${questionNumber}`;
                item.querySelector('.form-check-label').setAttribute('for', `question-required-${questionNumber}`);
                
                // Cập nhật name cho các lựa chọn
                const optionInputs = item.querySelectorAll('.options-list input');
                optionInputs.forEach(input => {
                    input.name = `questions[${questionNumber}][options][]`;
                });
            });
        }
        
        // Validate form trước khi submit
        document.getElementById('formAssignmentForm').addEventListener('submit', function(event) {
            const questionItems = document.querySelectorAll('.question-item');
            if (questionItems.length === 0) {
                event.preventDefault();
                alert('Vui lòng thêm ít nhất một câu hỏi cho bài tập.');
            }
        });
    });
</script>
@endsection 