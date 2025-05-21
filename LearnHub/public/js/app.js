/**
 * LearnHub - Main JavaScript File
 */

// Import Bootstrap
import { Tooltip, Popover } from "bootstrap"

document.addEventListener("DOMContentLoaded", () => {
  // Initialize tooltips
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map((tooltipTriggerEl) => new Tooltip(tooltipTriggerEl))

  // Initialize popovers
  var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
  var popoverList = popoverTriggerList.map((popoverTriggerEl) => new Popover(popoverTriggerEl))

  // Add animation to elements when they come into view
  const animateOnScroll = () => {
    const elements = document.querySelectorAll(".animate-on-scroll")

    elements.forEach((element) => {
      const elementPosition = element.getBoundingClientRect().top
      const windowHeight = window.innerHeight

      if (elementPosition < windowHeight - 50) {
        const animationClass = element.dataset.animation || "animate-fade-in"
        element.classList.add(animationClass)
        element.classList.remove("animate-on-scroll")
      }
    })
  }

  // Run animation on scroll
  window.addEventListener("scroll", animateOnScroll)
  animateOnScroll() // Run once on page load

  // Course progress animation
  const progressBars = document.querySelectorAll(".progress-bar")
  progressBars.forEach((bar) => {
    const value = bar.getAttribute("aria-valuenow")
    bar.style.width = "0%"

    setTimeout(() => {
      bar.style.width = value + "%"
    }, 300)
  })

  // Mobile menu toggle animation
  const navbarToggler = document.querySelector(".navbar-toggler")
  if (navbarToggler) {
    navbarToggler.addEventListener("click", () => {
      document.querySelector(".navbar-collapse").classList.toggle("animate-slide-down")
    })
  }

  // Add smooth scrolling to all links
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault()

      const targetId = this.getAttribute("href")
      if (targetId === "#") return

      const targetElement = document.querySelector(targetId)
      if (targetElement) {
        window.scrollTo({
          top: targetElement.offsetTop - 70,
          behavior: "smooth",
        })
      }
    })
  })

  // Course video player functionality
  const videoPlayers = document.querySelectorAll(".course-video-player")
  videoPlayers.forEach((player) => {
    const playButton = player.querySelector(".play-button")
    const video = player.querySelector("video")

    if (playButton && video) {
      playButton.addEventListener("click", () => {
        if (video.paused) {
          video.play()
          playButton.style.opacity = "0"
        } else {
          video.pause()
          playButton.style.opacity = "1"
        }
      })

      video.addEventListener("ended", () => {
        playButton.style.opacity = "1"
      })
    }
  })

  // Handle course enrollment form submission
  const enrollmentForm = document.getElementById("enrollment-form")
  if (enrollmentForm) {
    enrollmentForm.addEventListener("submit", function (e) {
      e.preventDefault()

      // Show loading state
      const submitButton = this.querySelector('button[type="submit"]')
      const originalText = submitButton.innerHTML
      submitButton.disabled = true
      submitButton.innerHTML =
        '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Đang xử lý...'

      // Simulate form submission (replace with actual AJAX call)
      setTimeout(() => {
        // Show success message
        const successAlert = document.createElement("div")
        successAlert.className = "alert alert-success animate-fade-in mt-3"
        successAlert.innerHTML = '<i class="bi bi-check-circle-fill me-2"></i> Đăng ký khóa học thành công!'

        enrollmentForm.appendChild(successAlert)

        // Reset button
        submitButton.disabled = false
        submitButton.innerHTML = originalText

        // Redirect after delay
        setTimeout(() => {
          window.location.href = "/dashboard"
        }, 2000)
      }, 1500)
    })
  }
})
