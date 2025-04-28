<?php

namespace App\Livewire;

use App\Models\Faq;
use Livewire\Component;

class ChatBot extends Component
{
    public $isOpen = false;
    public $query = '';
    public $faqs = [];
    public $searchResults = [];
    public $messages = [];
    public $loading = false;

    public function mount()
    {
        $this->faqs = Faq::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $this->messages = [
            ['type' => 'bot', 'content' => 'Hi! How can I help you today?']
        ];
    }

    public function toggleChat()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function updatedQuery()
    {
        if (empty($this->query)) {
            $this->searchResults = [];
            return;
        }

        $this->searchResults = $this->faqs
            ->filter(function ($faq) {
                return str_contains(strtolower($faq->question), strtolower($this->query)) ||
                       str_contains(strtolower($faq->answer), strtolower($this->query));
            })
            ->values()
            ->all();
    }

    public function sendMessage()
    {
        if (empty(trim($this->query))) {
            return;
        }

        // Add user message to chat
        $this->messages[] = [
            'type' => 'user',
            'content' => $this->query
        ];

        $this->loading = true;

        // Search FAQs for relevant answer
        $faqs = Faq::search($this->query)->get();

        if ($faqs->isNotEmpty()) {
            $bestMatch = $faqs->first();
            $this->messages[] = [
                'type' => 'bot',
                'content' => $bestMatch->answer
            ];
        } else {
            $this->messages[] = [
                'type' => 'bot',
                'content' => "I'm sorry, I couldn't find an answer to your question. Please try rephrasing or contact our support team for assistance."
            ];
        }

        $this->query = '';
        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.chat-bot');
    }
}
