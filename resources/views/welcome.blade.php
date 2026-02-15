<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reverb Messenger - Real-time Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/js/app.js'])
    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
            --success-color: #28a745;
            --message-bg: #f8f9fa;
            --border-light: #dee2e6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 20px 0;
        }

        .messenger-container {
            display: flex;
            height: calc(100vh - 40px);
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 380px;
            border-right: 1px solid var(--border-light);
            display: flex;
            flex-direction: column;
            background: white;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid var(--border-light);
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sidebar-header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-menu {
            position: relative;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .user-avatar:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .user-dropdown {
            position: absolute;
            top: 50px;
            right: 0;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            min-width: 200px;
            display: none;
            z-index: 1000;
            overflow: hidden;
        }

        .user-dropdown.show {
            display: block;
        }

        .user-dropdown-header {
            padding: 15px;
            border-bottom: 1px solid #e0e0e0;
            color: #333;
        }

        .user-dropdown-header p {
            margin: 0 0 5px 0;
            font-weight: 600;
        }

        .user-dropdown-header small {
            color: #999;
        }

        .user-dropdown-item {
            padding: 12px 15px;
            color: #333;
            cursor: pointer;
            transition: all 0.3s ease;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }

        .user-dropdown-item:hover {
            background: #f8f9fa;
        }

        .user-dropdown-item i {
            width: 16px;
            text-align: center;
        }

        .user-dropdown-item.logout {
            color: #dc3545;
        }

        .user-dropdown-item.logout:hover {
            background: #fff5f5;
        }

        .sidebar-search {
            padding: 15px;
            border-bottom: 1px solid var(--border-light);
        }

        .search-input {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid var(--border-light);
            border-radius: 20px;
            outline: none;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        }

        .conversations-list {
            flex: 1;
            overflow-y: auto;
            padding: 10px 0;
        }

        .conversation-item {
            padding: 12px 15px;
            border-left: 4px solid transparent;
            cursor: pointer;
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .conversation-item:hover {
            background: var(--message-bg);
            border-left-color: var(--primary-color);
        }

        .conversation-item.active {
            background: rgba(102, 126, 234, 0.1);
            border-left-color: var(--primary-color);
        }

        .conversation-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 18px;
            flex-shrink: 0;
            position: relative;
        }

        .conversation-avatar.online::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 14px;
            height: 14px;
            background: #28a745;
            border: 3px solid white;
            border-radius: 50%;
        }

        .conversation-info {
            flex: 1;
            min-width: 0;
        }

        .conversation-name {
            font-weight: 600;
            color: #333;
            margin-bottom: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .conversation-preview {
            font-size: 13px;
            color: #999;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .conversation-time {
            font-size: 12px;
            color: #999;
            flex-shrink: 0;
        }

        /* Chat Area Styles */
        .chat-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: white;
        }

        .chat-header {
            padding: 15px 25px;
            border-bottom: 1px solid var(--border-light);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
        }

        .chat-header-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .chat-header-details h3 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .chat-header-details p {
            margin: 0;
            font-size: 12px;
            color: #28a745;
        }

        .chat-header-actions {
            display: flex;
            gap: 10px;
        }

        .header-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: none;
            background: var(--message-bg);
            color: #666;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .header-btn:hover {
            background: var(--primary-color);
            color: white;
        }

        /* Messages Area */
        .messages-container {
            flex: 1;
            padding: 20px 25px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 15px;
            background: #fafafa;
        }

        .message-group {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }

        .message-group.sent {
            justify-content: flex-end;
        }

        .message-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
            flex-shrink: 0;
        }

        .message-group.sent .message-avatar {
            order: 2;
        }

        .message-content {
            max-width: 60%;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .message-group.sent .message-content {
            align-items: flex-end;
        }

        .message {
            padding: 10px 15px;
            border-radius: 18px;
            word-wrap: break-word;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .message.received {
            background: white;
            color: #333;
            border-bottom-left-radius: 4px;
        }

        .message.sent {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-bottom-right-radius: 4px;
        }

        .message-time {
            font-size: 11px;
            color: #999;
            padding: 0 5px;
        }

        .message-group.sent .message-time {
            text-align: right;
        }

        /* Input Area */
        .input-area {
            padding: 15px 25px;
            border-top: 1px solid var(--border-light);
            display: flex;
            gap: 10px;
            align-items: flex-end;
            background: white;
        }

        .input-wrapper {
            flex: 1;
            display: flex;
            gap: 8px;
            align-items: flex-end;
        }

        .input-actions {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: none;
            background: var(--message-bg);
            color: #666;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .action-btn:hover {
            background: var(--primary-color);
            color: white;
        }

        .message-input {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid var(--border-light);
            border-radius: 20px;
            outline: none;
            font-size: 14px;
            resize: none;
            max-height: 100px;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .message-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        }

        .send-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: none;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .send-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .send-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: scale(1);
        }

        /* Empty State */
        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            gap: 20px;
            color: #999;
        }

        .empty-state i {
            font-size: 60px;
            color: #ddd;
        }

        .empty-state p {
            font-size: 16px;
            margin: 0;
        }

        /* Scrollbar Styles */
        .conversations-list::-webkit-scrollbar,
        .messages-container::-webkit-scrollbar {
            width: 6px;
        }

        .conversations-list::-webkit-scrollbar-track,
        .messages-container::-webkit-scrollbar-track {
            background: transparent;
        }

        .conversations-list::-webkit-scrollbar-thumb,
        .messages-container::-webkit-scrollbar-thumb {
            background: #ddd;
            border-radius: 3px;
        }

        .conversations-list::-webkit-scrollbar-thumb:hover,
        .messages-container::-webkit-scrollbar-thumb:hover {
            background: #bbb;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .messenger-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: 200px;
                border-right: none;
                border-bottom: 1px solid var(--border-light);
            }

            .conversations-list {
                display: flex;
                overflow-x: auto;
                overflow-y: hidden;
                padding: 10px;
            }

            .conversation-item {
                min-width: 200px;
                border-left: none;
                border-bottom: none;
                border-radius: 12px;
                flex-direction: column;
                text-align: center;
                padding: 15px 10px;
            }

            .chat-area {
                height: auto;
                flex: 1;
            }

            .message-content {
                max-width: 80%;
            }
        }

        @media (max-width: 480px) {
            .sidebar {
                height: 150px;
            }

            .conversation-item {
                min-width: 160px;
                padding: 10px 8px;
            }

            .conversation-info {
                display: none;
            }

            .message-content {
                max-width: 85%;
            }

            .chat-header {
                padding: 10px 15px;
            }

            .input-area {
                padding: 10px 15px;
            }

            .messages-container {
                padding: 15px;
            }
        }

        .typing-indicator {
            display: flex;
            gap: 4px;
            padding: 10px 15px;
        }

        .typing-dot {
            width: 8px;
            height: 8px;
            background: #999;
            border-radius: 50%;
            animation: typing 1.4s infinite;
        }

        .typing-dot:nth-child(2) {
            animation-delay: 0.2s;
        }

        .typing-dot:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes typing {
            0%, 60%, 100% {
                opacity: 0.5;
                transform: translateY(0);
            }
            30% {
                opacity: 1;
                transform: translateY(-10px);
            }
        }

        .badge-unread {
            background: #dc3545;
            color: white;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            margin-left: auto;
        }
    </style>
</head>
<body>
    <div class="container-fluid px-2 px-md-4 py-3">
        <div class="messenger-container" id="app">
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="sidebar-header">
                    <h2><i class="fas fa-comments"></i> Messages</h2>
                    <div class="user-menu">
                        <div class="user-avatar" id="userAvatar" title="User menu">
                            {{ strtoupper(substr(Auth::user()->name, 0, 4)) }}
                        </div>
                        <div class="user-dropdown" id="userDropdown">
                            <div class="user-dropdown-header">
                                <p>{{ Auth::user()->name }}</p>
                                <small>{{ Auth::user()->email }}</small>
                            </div>
                            <div class="user-dropdown-item">
                                <i class="fas fa-user-circle"></i>
                                View Profile
                            </div>
                            <div class="user-dropdown-item">
                                <i class="fas fa-cog"></i>
                                Settings
                            </div>
                            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="user-dropdown-item logout" style="width: 100%; border: none; background: none; cursor: pointer; text-align: left;">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="sidebar-search">
                    <input type="text" class="search-input" id="searchInput" placeholder="Search conversations...">
                </div>

                <div class="conversations-list" id="conversationsList">
                    <!-- Conversations will be loaded here -->
                    @foreach($users as $conversation)
                        <div class="conversation-item" data-user-id="{{ $conversation->id }}">
                            <div class="conversation-avatar online">
                              {{ strtoupper(substr($conversation->name, 0, 4)) }}



                            </div>
                            <div class="conversation-info">
                                
                                <div class="conversation-name">{{ $conversation->name }}</div>
                                {{-- <div class="conversation-preview">{{ $conversation['preview'] }}</div> --}}
                            </div>
                            <div class="conversation-time">{{ $conversation->created_at->diffForHumans() }}</div>
                        </div>
                    @endforeach
                </div>
                {{-- <div class="conversations-list" id="conversationsList">
                    <!-- Conversations will be loaded here -->
                    @foreach([
                        ['id' => 1, 'name' => 'John Doe', 'avatar' => 'JD', 'preview' => 'Hey, how are you?', 'time' => '2m', 'online' => true],
                        ['id' => 2, 'name' => 'Sarah Smith', 'avatar' => 'SS', 'preview' => 'See you tomorrow!', 'time' => '1h', 'online' => true],
                        ['id' => 3, 'name' => 'Mike Johnson', 'avatar' => 'MJ', 'preview' => 'Thanks for the help', 'time' => '3h', 'online' => false],
                        ['id' => 4, 'name' => 'Emma Wilson', 'avatar' => 'EW', 'preview' => 'Perfect! Let\'s do it', 'time' => '5h', 'online' => true],
                    ] as $conversation)
                        <div class="conversation-item" data-conversation-id="{{ $conversation['id'] }}">
                            <div class="conversation-avatar {{ $conversation['online'] ? 'online' : '' }}">
                                {{ $conversation['avatar'] }}
                            </div>
                            <div class="conversation-info">
                                <div class="conversation-name">{{ $conversation['name'] }}</div>
                                <div class="conversation-preview">{{ $conversation['preview'] }}</div>
                            </div>
                            <div class="conversation-time">{{ $conversation['time'] }}</div>
                        </div>
                    @endforeach
                </div> --}}
            </div>

            <!-- Chat Area -->
            <div class="chat-area" id="chatArea">
                <div class="chat-header">
                    <div class="chat-header-info">
                        <div class="conversation-avatar online" style="width: 45px; height: 45px;">
                            JD
                        </div>
                        <div class="chat-header-details">
                            <h3>John Doe</h3>
                            <p><i class="fas fa-circle" style="font-size: 8px;"></i> Online</p>
                        </div>
                    </div>
                    <div class="chat-header-actions">
                        <button class="header-btn" title="Call">
                            <i class="fas fa-phone"></i>
                        </button>
                        <button class="header-btn" title="Video Call">
                            <i class="fas fa-video"></i>
                        </button>
                        <button class="header-btn" title="Info">
                            <i class="fas fa-info-circle"></i>
                        </button>
                    </div>
                </div>

                <div class="messages-container" id="messagesContainer">
                    <!-- Messages will be displayed here -->
                    <div class="message-group">
                        <div class="message-avatar">JD</div>
                        <div class="message-content">
                            <div class="message received">
                                Hey! How's it going?
                            </div>
                            <div class="message-time">10:30 AM</div>
                        </div>
                    </div>

                    <div class="message-group sent">
                        <div class="message-avatar">You</div>
                        <div class="message-content">
                            <div class="message sent">
                                Hi John! I'm doing great, thanks for asking!
                            </div>
                            <div class="message-time">10:32 AM</div>
                        </div>
                    </div>

                    <div class="message-group">
                        <div class="message-avatar">JD</div>
                        <div class="message-content">
                            <div class="message received">
                                Want to grab coffee later?
                            </div>
                            <div class="message-time">10:35 AM</div>
                        </div>
                    </div>

                    <div class="message-group sent">
                        <div class="message-avatar">You</div>
                        <div class="message-content">
                            <div class="message sent">
                                Absolutely! What time works for you?
                            </div>
                            <div class="message-time">10:36 AM</div>
                        </div>
                    </div>
                </div>

                <div class="input-area">
                    <div class="input-wrapper">
                        <div class="input-actions">
                            <button class="action-btn" title="Attach file">
                                <i class="fas fa-paperclip"></i>
                            </button>
                            <button class="action-btn" title="Add emoji">
                                <i class="fas fa-smile"></i>
                            </button>
                        </div>
                        <textarea class="message-input" id="messageInput" placeholder="Type a message..." rows="1"></textarea>
                    </div>
                    <button class="send-btn" id="sendBtn" title="Send message">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <script>
        document.addEventListener('DOMContentLoaded', function() {
            const messageInput = document.getElementById('messageInput');
            const sendBtn = document.getElementById('sendBtn');
            const messagesContainer = document.getElementById('messagesContainer');
            const conversationItems = Array.from(document.querySelectorAll('.conversation-item'));
            const userAvatar = document.getElementById('userAvatar');
            const userDropdown = document.getElementById('userDropdown');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const currentUserId = {{ auth()->id() }};
            
            // Debugging
            console.log('Current User ID:', currentUserId);
            
            if (window.Echo) {
                console.log('Echo initialized. Configuring listener...');
                
                window.Echo.connector.pusher.connection.bind('state_change', function(states) {
                    console.log('Connection state changed:', states);
                    const statusDot = document.querySelector('.user-menu .user-avatar');
                    if (states.current === 'connected') {
                        statusDot.style.borderColor = '#28a745'; // Green border when connected
                        statusDot.title = 'Connected to Reverb';
                    } else {
                        statusDot.style.borderColor = '#dc3545'; // Red border when disconnected
                        statusDot.title = 'Disconnected: ' + states.current;
                    }
                });

                window.Echo.connector.pusher.connection.bind('error', function(err) {
                    console.error('Connection error:', err);
                });

                window.Echo.private(`chat.${currentUserId}`).listen('MessageSent', (e) => {
                    console.log('Message received:', e);
                    
                    // If the message is from the currently active conversation, append it
                    if (activeConversationId && e.message.from_id == activeConversationId) {
                        const group = document.createElement('div');
                        group.className = 'message-group';
                        
                        const senderName = e.sender.name || 'User';
                        const avatarText = senderName.slice(0, 2).toUpperCase();
                        const time = new Date(e.message.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                        
                        group.innerHTML = `
                            <div class="message-avatar">${escapeHtml(avatarText)}</div>
                            <div class="message-content">
                                <div class="message received">${escapeHtml(e.message.message)}</div>
                                <div class="message-time">${time}</div>
                            </div>
                        `;
                        
                        messagesContainer.appendChild(group);
                        messagesContainer.scrollTop = messagesContainer.scrollHeight;
                    } 
                    
                    // Optional: Update conversation list preview/unread count here if needed
                    // For now, we'll just focus on the active chat updating
                });
            }

            function escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }

            // Auto-resize textarea
            messageInput.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight > 100 ? 100 : this.scrollHeight) + 'px';
                sendBtn.disabled = !this.value.trim();
            });

            // Send message via AJAX
            sendBtn.addEventListener('click', sendMessage);
            messageInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    sendMessage();
                }
            });

            let activeConversationId = null;

            function renderMessages(messages) {
                messagesContainer.innerHTML = '';
                messages.forEach(msg => {
                    const isSent = msg.from_id === currentUserId;
                    const group = document.createElement('div');
                    group.className = 'message-group' + (isSent ? ' sent' : '');
                    const avatarText = isSent ? 'You' : (msg.sender ? (msg.sender.name || 'JD').slice(0,2).toUpperCase() : 'JD');
                    const time = new Date(msg.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                    group.innerHTML = `
                        <div class="message-avatar">${escapeHtml(avatarText)}</div>
                        <div class="message-content">
                            <div class="message ${isSent ? 'sent' : 'received'}">${escapeHtml(msg.message)}</div>
                            <div class="message-time">${time}</div>
                        </div>
                    `;
                    messagesContainer.appendChild(group);
                });
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }

            async function loadConversation(userId, userName) {
                activeConversationId = userId;
                // update header
                const headerAvatar = document.querySelector('.chat-header .conversation-avatar');
                if (headerAvatar) headerAvatar.textContent = userName.slice(0,2).toUpperCase();
                const headerName = document.querySelector('.chat-header-details h3');
                if (headerName) headerName.textContent = userName;

                try {
                    const res = await fetch(`/messages/${userId}`);
                    if (!res.ok) throw new Error('Failed to fetch messages');
                    const data = await res.json();
                    renderMessages(data);
                } catch (err) {
                    console.error(err);
                }
            }

            async function sendMessage() {
                const message = messageInput.value.trim();
                if (!message || !activeConversationId) return;

                const payload = { to_id: activeConversationId, message };

                try {
                    const res = await fetch('/send-message', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(payload)
                    });

                    const data = await res.json();

                    // Append the message locally for instant feedback
                    const group = document.createElement('div');
                    group.className = 'message-group sent';
                    const time = new Date(data.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                    group.innerHTML = `
                        <div class="message-avatar">You</div>
                        <div class="message-content">
                            <div class="message sent">${escapeHtml(data.message)}</div>
                            <div class="message-time">${time}</div>
                        </div>
                    `;
                    messagesContainer.appendChild(group);
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                } catch (err) {
                    console.error(err);
                } finally {
                    messageInput.value = '';
                    messageInput.style.height = 'auto';
                    sendBtn.disabled = true;
                }
            }

            // Conversation selection
            conversationItems.forEach(item => {
                item.addEventListener('click', function() {
                    conversationItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                    const userId = this.getAttribute('data-user-id');
                    const nameEl = this.querySelector('.conversation-name');
                    const userName = nameEl ? nameEl.textContent.trim() : 'User';
                    loadConversation(userId, userName);
                });
            });

            // Search conversations
            document.getElementById('searchInput').addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                conversationItems.forEach(item => {
                    const name = item.querySelector('.conversation-name').textContent.toLowerCase();
                    item.style.display = name.includes(searchTerm) ? 'flex' : 'none';
                });
            });

            // Set first conversation as active and load
            if (conversationItems.length > 0) {
                const first = conversationItems[0];
                first.classList.add('active');
                const userId = first.getAttribute('data-user-id');
                const userName = first.querySelector('.conversation-name').textContent.trim();
                loadConversation(userId, userName);
            }

            // Initialize disabled state
            sendBtn.disabled = true;

            // User menu functionality
            userAvatar.addEventListener('click', function(e) {
                e.stopPropagation();
                userDropdown.classList.toggle('show');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!userAvatar.contains(e.target) && !userDropdown.contains(e.target)) {
                    userDropdown.classList.remove('show');
                }
            });
        });
    </script>
</body>
</html>
