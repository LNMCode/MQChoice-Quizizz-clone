import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:mobileapplication/components/constants.dart';
import 'package:mobileapplication/components/rounded_button.dart';
import 'package:mobileapplication/components/rounded_input_field.dart';
import 'package:mobileapplication/screens/entercode/blocs/entercode/entercode_bloc.dart';
import 'package:mobileapplication/screens/entercode/blocs/entercode/entercode_event.dart';
import 'package:mobileapplication/screens/entercode/blocs/entercode/entercode_state.dart';

class EnterCodeContainer extends StatelessWidget {
  final ValueChanged<String> onChangeEnterCode;
  final ValueChanged<String> onChangeUserName;
  final Function() onPress;

  const EnterCodeContainer({
    Key? key,
    required this.onChangeEnterCode,
    required this.onChangeUserName,
    required this.onPress,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;
    return Container(
      margin: const EdgeInsets.symmetric(vertical: 10),
      padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 5),
      width: size.width,
      child: _Body(
        onChangeEnterCode: onChangeEnterCode,
        onChangeUserName: onChangeUserName,
        onPress: onPress,
      ),
    );
  }
}

class _Body extends StatelessWidget {
  final ValueChanged<String> onChangeEnterCode;
  final ValueChanged<String> onChangeUserName;
  final Function() onPress;

  const _Body({
    required this.onChangeEnterCode,
    required this.onChangeUserName,
    required this.onPress,
  });

  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;
    return Column(
      children: <Widget>[
        SizedBox(
          width: size.width,
          child: Container(
            padding: const EdgeInsets.symmetric(vertical: 10),
            child: const Text(
              "Playing a game?",
              textAlign: TextAlign.left,
              style: TextStyle(
                fontSize: 18,
                fontWeight: FontWeight.bold,
                color: Colors.black87,
              ),
            ),
          ),
        ),
        Container(
          padding: const EdgeInsets.symmetric(horizontal: 5, vertical: 5),
          decoration: BoxDecoration(
            color: const Color(0xFFF2F2F2),
            border: Border.all(color: borderColor, width: 2),
            borderRadius: BorderRadius.circular(10),
          ),
          child: _Form(
            onChangedEnterCode: onChangeEnterCode,
            onChangeUserName: onChangeUserName,
            onPress: onPress,
          ),
        ),
        _NotificationResponse(),
      ],
    );
  }
}

class _Form extends StatelessWidget {
  final ValueChanged<String> onChangedEnterCode;
  final ValueChanged<String> onChangeUserName;
  final Function() onPress;

  const _Form({
    required this.onChangedEnterCode,
    required this.onChangeUserName,
    required this.onPress,
  });

  @override
  Widget build(BuildContext context) {
    return Column(
      children: <Widget>[
        Column(
          children: <Widget>[
            _Input(
              hintText: 'Enter a code game',
              onChanged: onChangedEnterCode,
            ),
            _Input(
              hintText: 'Enter a name',
              onChanged: onChangeUserName,
            ),
            _Button(
              onPress: onPress,
            ),
          ],
        ),
      ],
    );
  }
}

class _Input extends StatelessWidget {
  final String hintText;
  final ValueChanged<String> onChanged;

  const _Input({
    required this.hintText,
    required this.onChanged,
  });

  @override
  Widget build(BuildContext context) {
    return RoundedInputField(
      hintText: hintText,
      onChanged: onChanged,
    );
  }
}

class _Button extends StatelessWidget {
  final Function() onPress;

  const _Button({
    required this.onPress,
  });

  @override
  Widget build(BuildContext context) {
    return BlocBuilder<EnterCodeBloc, EnterCodeState>(
      builder: (context, state) {
        return RoundedButton(
          text: 'Join a game',
          isLoading: state is EnterCodeStateLoading,
          press: onPress,
        );
      },
    );
  }
}

// Notification or Navigation to Wait Room Page
class _NotificationResponse extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;
    return BlocBuilder<EnterCodeBloc, EnterCodeState>(
      builder: (context, state) {
        if (state is EnterCodeStateSuccess) {
          return SizedBox(
            width: size.width,
            child: Container(
              margin: const EdgeInsets.symmetric(vertical: 15),
              padding: const EdgeInsets.symmetric(vertical: 10),
              decoration: BoxDecoration(
                color: Colors.red,
                borderRadius: BorderRadius.circular(10),
              ),
              child: Text(
                state.enterCodeResponse.message,
                textAlign: TextAlign.center,
                style: const TextStyle(
                  fontSize: 15,
                  color: Colors.white,
                ),
              ),
            ),
          );
        }
        return Container();
      },
    );
  }
}
