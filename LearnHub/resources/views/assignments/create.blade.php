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
                    
                    <form action="{{ route('assignments.store', $lesson) }}" method="POST" id="assignmentForm">
                        @csrf
                        
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
                        
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Câu hỏi</label>
                            <div class="form-text mb-3">Tạo các câu hỏi cho bài tập.</div>
                            
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
            
            // Xử lý sự kiện xóa lựa chọn
            const removeOptionBtns = questionItem.querySelectorAll('.remove-option');
            removeOptionBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const optionsList = this.closest('.options-list');
                    if (optionsList.children.length > 2) {
                        this.closest('.input-group').remove();
                    } else {
                        alert('Cần có ít nhất 2 lựa chọn cho câu hỏi trắc nghiệm');
                    }
                });
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
                const optionsList = this.closest('.options-list');
                if (optionsList.children.length > 2) {
                    this.closest('.input-group').remove();
                } else {
                    alert('Cần có ít nhất 2 lựa chọn cho câu hỏi trắc nghiệm');
                }
            });
            
            optionsList.appendChild(optionItem);
        }
        
        // Hàm cập nhật số thứ tự câu hỏi
        function updateQuestionNumbers() {
            const questionItems = document.querySelectorAll('.question-item');
            questionItems.forEach((item, index) => {
                const questionNumber = index + 1;
                item.querySelector('.question-number').textContent = questionNumber;
                
                // Cập nhật name
                item.querySelector('.question-text').name = `questions[${questionNumber}][text]`;
                item.querySelector('.question-type').name = `questions[${questionNumber}][type]`;
                item.querySelector('.form-check-input').name = `questions[${questionNumber}][required]`;
                item.querySelector('.form-check-input').id = `question-required-${questionNumber}`;
                item.querySelector('.form-check-label').setAttribute('for', `question-required-${questionNumber}`);
                
                // Cập nhật name cho các options
                const options = item.querySelectorAll('.options-list input');
                options.forEach(option => {
                    option.name = `questions[${questionNumber}][options][]`;
                });
            });
        }
        
        // Xử lý khi submit form
        document.getElementById('assignmentForm').addEventListener('submit', function(e) {
            // Thêm trường ẩn is_form với giá trị 1
            const isFormInput = document.createElement('input');
            isFormInput.type = 'hidden';
            isFormInput.name = 'is_form';
            isFormInput.value = '1';
            this.appendChild(isFormInput);
        });
    });
</script>
@endsection 