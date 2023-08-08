$(".half-image").each(function() {
            var a = $(this);
            this.complete ? a.css({
                height: this.naturalHeight / 2 + "px",
                width: this.naturalWidth / 2 + "px"
            }) : a.on("load", function() {
                a.css({
                    height: this.naturalHeight / 2 + "px",
                    width: this.naturalWidth / 2 + "px"
                })
            })
        });