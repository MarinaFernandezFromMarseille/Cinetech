# Markdown Cheatsheet

Markdown is a lightweight markup language for creating formatted text. Below is an example demonstrating all key commands.

---

## Headings
Use `#` for headings:
```markdown
# Heading 1
## Heading 2
### Heading 3
#### Heading 4
##### Heading 5
###### Heading 6
```

# Heading 1
## Heading 2
### Heading 3
#### Heading 4
##### Heading 5
###### Heading 6

---

## Text Formatting
You can format text using:
- **Bold**: `**bold**` or `__bold__`
- *Italic*: `*italic*` or `_italic_`
- ~~Strikethrough~~: `~~strikethrough~~`

Example:
```markdown
**Bold Text**
*Italic Text*
~~Strikethrough~~
```

Output:
**Bold Text**  
*Italic Text*  
~~Strikethrough~~

---

## Lists

### Unordered List
Use `-`, `+`, or `*`:
```markdown
- Item 1
- Item 2
  - Sub-item 2.1
  - Sub-item 2.2
```

- Item 1
- Item 2
  - Sub-item 2.1
  - Sub-item 2.2

### Ordered List
Use numbers followed by a period:
```markdown
1. Item 1
2. Item 2
   1. Sub-item 2.1
   2. Sub-item 2.2
```

1. Item 1
2. Item 2
   1. Sub-item 2.1
   2. Sub-item 2.2

---

## Links
Create links with `[text](URL)`:
```markdown
[OpenAI](https://openai.com)
```
[OpenAI](https://openai.com)

---

## Images
Insert images using `![alt text](URL)`:
```markdown
![OpenAI Logo](https://openai.com/favicon.ico)
```

![OpenAI Logo](https://openai.com/favicon.ico)

---

## Blockquotes
Use `>` for blockquotes:
```markdown
> "The only limit to our realization of tomorrow is our doubts of today."  
> – Franklin D. Roosevelt
```

> "The only limit to our realization of tomorrow is our doubts of today."  
> – Franklin D. Roosevelt

---

## Code Blocks
Inline code: `` `code` ``  
Block code:
```markdown
```
Code block example
```
```

Inline example: `print("Hello, World!")`  
Block example:
```python
def greet():
    print("Hello, World!")
```

---

## Tables
Create tables using pipes `|` and dashes `-`:
```markdown
| Header 1 | Header 2 |
|----------|----------|
| Row 1    | Value 1  |
| Row 2    | Value 2  |
```

| Header 1 | Header 2 |
|----------|----------|
| Row 1    | Value 1  |
| Row 2    | Value 2  |

---

## Horizontal Line
Use three dashes `---` or asterisks `***`:
```markdown
---
```

---

## Tasks (Checklists)
Use `- [ ]` for unchecked or `- [x]` for checked:
```markdown
- [x] Completed Task
- [ ] Incomplete Task
```

- [x] Completed Task
- [ ] Incomplete Task

---

## Escape Characters
Use `\` to escape special characters:
```markdown
\*This text is not italicized\*
```

\*This text is not italicized\*

---

## Footnotes
Use `[^1]` for footnotes:
```markdown
Here's a sentence with a footnote.[^1]

[^1]: This is the footnote.
```

Here's a sentence with a footnote.[^1]

[^1]: This is the footnote.

---

## Emojis
Use emoji shortcodes:
```markdown
:smile: :rocket:
```

😄 🚀

---

## Math (if supported)
Use `$` for inline math or `$$` for block math:
```markdown
Inline math: $E = mc^2$
Block math:
$$
E = mc^2
$$
```

Inline math: $E = mc^2$  
Block math:  
$$
E = mc^2
$$

---

## Nested Formatting
Combine multiple formats:
```markdown
**Bold _and Italic_**
~~Strikethrough *and Italic*~~
```

**Bold _and Italic_**  
~~Strikethrough *and Italic*~~

---

This Markdown file includes all major commands. Modify or extend it as needed!