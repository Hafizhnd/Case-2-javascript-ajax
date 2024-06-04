class InteractiveChatbox {
    constructor(a, b, c) {
        this.args = {
            button: a,
            chatbox: b
        }
        this.icons = c;
        this.state = false; 
    }

    display() {
        const {button, chatbox} = this.args;
        
        button.addEventListener('click', () => this.toggleState(chatbox))
    }

    toggleState(chatbox) {
        this.state = !this.state;
        this.showOrHideChatBox(chatbox, this.args.button);
    }

    showOrHideChatBox(chatbox, button) {
        if(this.state) {
            chatbox.classList.add('chatbox--active')
            this.toggleIcon(true, button);
        } else if (!this.state) {
            chatbox.classList.remove('chatbox--active')
            this.toggleIcon(false, button);
        }
    }

    toggleIcon(state, button) {
        // Periksa apakah objek icons terdefinisi
        if (this.icons && typeof this.icons.isClicked !== 'undefined' && typeof this.icons.isNotClicked !== 'undefined') {
            const { isClicked, isNotClicked } = this.icons;
            let b = button.children[0].innerHTML;
    
            if (state) {
                button.children[0].innerHTML = isClicked;
            } else if (!state) {
                button.children[0].innerHTML = isNotClicked;
            }
        } else {
            console.error("Object icons is not defined or is missing isClicked or isNotClicked property.");
        }
    }
    
}

const chatboxSupportElement = document.querySelector('.chatbox__support');
chatboxSupportElement.style.backgroundColor = '#f9f9f9';
chatboxSupportElement.style.height = '550px';
chatboxSupportElement.style.width = '350px';
chatboxSupportElement.style.border = '2px solid #9e72c3';