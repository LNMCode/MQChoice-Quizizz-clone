import 'package:flutter/material.dart';
import 'package:mobileapplication/components/constants.dart';
import 'package:mobileapplication/components/jumping_dots.dart';

class RoundedButton extends StatelessWidget {
  final String text;
  final Function()? press;
  final Color color, textColor;
  final double radius;
  final bool isLoading;
  final EdgeInsets? margin;

  const RoundedButton({
    Key? key,
    required this.text,
    this.press,
    this.color = kPrimaryColor,
    this.textColor = Colors.white,
    this.radius = 10,
    this.isLoading = false,
    this.margin,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;
    return Container(
      width: size.width,
      margin: margin,
      child: ClipRRect(
        borderRadius: BorderRadius.circular(radius),
        child: newElevatedButton(),
      ),
    );
  }

  //Used:ElevatedButton as FlatButton is deprecated.
  //Here we have to apply customizations to Button by inheriting the styleFrom

  Widget newElevatedButton() {
    return ElevatedButton(
      child: isLoading
          ? JumpingDotsProgressIndicator(
              dotSpacing: 2,
              fontSize: 12,
              color: Colors.white,
              milliseconds: 400,
            )
          : Text(
              text,
              style: TextStyle(color: textColor),
            ),
      onPressed: press,
      style: ElevatedButton.styleFrom(
        primary: color,
        padding: EdgeInsets.symmetric(horizontal: 40, vertical: 20),
        textStyle: TextStyle(color: textColor, fontSize: 15),
      ),
    );
  }
}
